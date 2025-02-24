import { db, eq, Posts } from "astro:db";
import createHttpError from "http-errors";
import { env } from "~/lib/env";
import { ApiRoute } from "~/lib/utils/ApiRoute";
import seedJson from "../../../db/seed.json";

/**
 * Identifies invalid blurhashes in the database and sets them to undefined.
 * Only available in development mode.
 *
 * @see http://localhost:3000/api/migrate_rebuild_blurhash/
 *
 * @example
 * ```bash
 * curl -s http://localhost:3000/api/migrate_rebuild_blurhash/ | json_pp
 * ```
 */
export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  const results = {
    total: 0,
    invalid: 0,
    updated: 0,
    errors: [] as Array<{ instagram_uuid: string; error: string }>,
  };

  // Function to validate blurhash
  const isValidBlurhash = (hash: string | undefined | null): boolean => {
    if (!hash) return false;
    // Blurhash must be at least 6 characters long and start with ":"
    return hash.length >= 6 && hash.startsWith(":");
  };

  try {
    // Read all posts from seed.json
    const seedPosts = seedJson as Array<{
      instagram_uuid: string;
      filepath: string;
      blurhash?: string;
      posted_at: string;
    }>;

    results.total = seedPosts.length;

    // Find invalid blurhashes
    const invalidPosts = seedPosts.filter(
      (post) => post.blurhash && !isValidBlurhash(post.blurhash),
    );

    results.invalid = invalidPosts.length;

    // Update posts with invalid blurhashes
    for (const post of invalidPosts) {
      try {
        await db
          .update(Posts)
          .set({ blurhash: null })
          .where(eq(Posts.instagram_uuid, post.instagram_uuid));
        results.updated++;
      } catch (error) {
        const errorMessage =
          error instanceof Error ? error.message : String(error);
        results.errors.push({
          instagram_uuid: post.instagram_uuid,
          error: errorMessage,
        });
      }
    }

    console.log(`
      Migration complete:
      - Total posts: ${results.total}
      - Invalid blurhashes found: ${results.invalid}
      - Successfully updated: ${results.updated}
      - Errors: ${results.errors.length}
    `);

    return results;
  } catch (error) {
    const errorMessage = error instanceof Error ? error.message : String(error);
    throw createHttpError.InternalServerError(
      "Failed to process blurhashes: " + errorMessage,
    );
  }
});
