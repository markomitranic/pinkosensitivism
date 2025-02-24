import { and, count, db, eq, isNull, ne, or, Posts } from "astro:db";
import fs from "fs";
import { readFile, writeFile } from "fs/promises";
import createHttpError from "http-errors";
import path from "path";
import { env } from "~/lib/env";
import { ApiRoute } from "~/lib/utils/ApiRoute";
import type { DrizzleBatchParams } from "~/lib/utils/types/DrizzleBatchParams";
import seedJson from "../../../db/seed.json";

type SeedPost = {
  instagram_uuid: string;
  filepath: string;
  posted_at: string;
  blurhash?: string;
};

/**
 * Updates the database with blurhashes from the CSV file.
 * Also updates the seed.json file with the blurhashes.
 * Only available in development mode.
 * Only updates rows where blurhash is null or different from the new value.
 *
 * @see http://localhost:3000/api/migrate_blurhash/
 *
 * @example
 * ```bash
 * curl -s http://localhost:3000/api/migrate_blurhash/ | json_pp
 * ```
 */
export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  const CSV_FILE = path.join(process.cwd(), "blurhashes.csv");
  if (!fs.existsSync(CSV_FILE)) {
    throw createHttpError.NotFound(
      "CSV file not found. Run migrate_blog_blurhash_local first.",
    );
  }

  // Load all posts from database to get the mapping between IDs and instagram_uuids
  const dbPosts = await db.select().from(Posts);
  const idToUuidMap = new Map(
    dbPosts.map((post) => [post.id, post.instagram_uuid]),
  );

  const csvContent = await readFile(CSV_FILE, "utf-8");
  const lines = csvContent.split("\n");

  // Skip header line and empty lines
  const entries = lines
    .slice(1)
    .filter((line) => line.trim())
    .map((line) => {
      const [id, blurhash] = line.split(",");
      return { id: Number(id), blurhash: blurhash.trim() };
    });

  const results = {
    total: entries.length,
    processed: 0,
    skipped: 0,
    failed: 0,
    errors: [] as Array<{ id: number; error: string }>,
    seed_updated: 0,
  };

  // Create a map of instagram_uuid to blurhash for updating seed.json
  const blurhashMap = new Map<string, string>();
  for (const entry of entries) {
    const instagram_uuid = idToUuidMap.get(entry.id);
    if (instagram_uuid) {
      blurhashMap.set(instagram_uuid, entry.blurhash);
    }
  }

  // Update seed.json with blurhashes
  const updatedSeed = (seedJson as SeedPost[]).map((post) => {
    const blurhash = blurhashMap.get(post.instagram_uuid);
    if (blurhash) {
      results.seed_updated++;
      return { ...post, blurhash };
    }
    return post;
  });

  // Save updated seed.json to a new file
  const NEW_SEED_FILE = path.join(
    process.cwd(),
    "db",
    "seed.with-blurhash.json",
  );
  await writeFile(NEW_SEED_FILE, JSON.stringify(updatedSeed, null, 2));
  console.log(`✓ Created new seed file with blurhashes at: ${NEW_SEED_FILE}`);

  // Initialize queries array with a count query to satisfy DrizzleBatchParams type
  const queries: DrizzleBatchParams = [
    db.select({ count: count() }).from(Posts),
  ];

  // Prepare batch update queries
  for (const entry of entries) {
    try {
      // Only update if blurhash is null or different from the new value
      queries.push(
        db
          .update(Posts)
          .set({ blurhash: entry.blurhash })
          .where(
            and(
              eq(Posts.id, entry.id),
              // Update if blurhash is null OR different from new value
              or(isNull(Posts.blurhash), ne(Posts.blurhash, entry.blurhash)),
            ),
          ),
      );
      results.processed++;
    } catch (error) {
      const errorMessage =
        error instanceof Error ? error.message : String(error);
      console.error(
        `✗ Error preparing update for ID ${entry.id}:`,
        errorMessage,
      );
      results.failed++;
      results.errors.push({
        id: entry.id,
        error: errorMessage,
      });
    }
  }

  // Execute all updates in one batch
  if (queries.length > 1) {
    // More than just the initial count query
    try {
      await db.batch(queries);
      console.log(
        `✓ Successfully executed ${queries.length - 1} database updates`,
      );
    } catch (error) {
      const errorMessage =
        error instanceof Error ? error.message : String(error);
      console.error("✗ Batch update failed:", errorMessage);
      throw createHttpError.InternalServerError(
        "Failed to update database: " + errorMessage,
      );
    }
  }

  console.log(`
    Migration complete:
    - Total entries: ${results.total}
    - Processed: ${results.processed}
    - Failed: ${results.failed}
    - Seed entries updated: ${results.seed_updated}
    - New seed file: ${NEW_SEED_FILE}
  `);

  return results;
});
