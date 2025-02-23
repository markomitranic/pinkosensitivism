import { db, Posts } from "astro:db";
import fs from "fs";
import { appendFile, readFile } from "fs/promises";
import createHttpError from "http-errors";
import path from "path";
import { env } from "~/lib/env";
import { PostRepository } from "~/lib/PostRepository";
import { ApiRoute } from "~/lib/utils/ApiRoute";
/**
 * Calculates and stores image placeholders for all images in the database.
 * Uses local files instead of blob storage.
 * Saves results to a CSV file instead of updating the database directly.
 * Only available in development mode.
 *
 * @see http://localhost:3000/api/migrate_blog_blurhash_local/
 *
 * @example
 * ```bash
 * curl -s http://localhost:3000/api/migrate_blog_blurhash_local/ | json_pp
 * ```
 */
export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  const LOCAL_POSTS_DIR =
    "/Users/markomitranic/Sites/pinkosensitivism-old/posts/";
  const CSV_FILE = path.join(process.cwd(), "blurhashes.csv");
  const posts = await db.select().from(Posts);
  const results = {
    total: posts.length,
    processed: 0,
    skipped: 0,
    failed: 0,
    errors: [] as Array<{ file: string; error: string }>,
  };

  // Load existing CSV entries into a Set for quick lookup
  const processedIds = new Set<number>();
  if (fs.existsSync(CSV_FILE)) {
    const csvContent = await readFile(CSV_FILE, "utf-8");
    const lines = csvContent.split("\n");
    // Skip header line and empty lines
    lines
      .slice(1)
      .filter((line) => line.trim())
      .forEach((line) => {
        const [id] = line.split(",");
        processedIds.add(Number(id));
      });
  } else {
    // Create CSV file with headers if it doesn't exist
    await appendFile(CSV_FILE, "post_id,blurhash\n");
  }

  for (const post of posts) {
    try {
      // Skip if already processed in CSV
      if (processedIds.has(post.id)) {
        console.log(`Skipping ${post.filepath} - already in CSV`);
        results.skipped++;
        continue;
      }

      // Get the local file path
      const localFilePath = path.join(LOCAL_POSTS_DIR, post.filepath);

      // Check if file exists
      if (!fs.existsSync(localFilePath)) {
        throw new Error(`File does not exist at ${localFilePath}`);
      }

      console.log(`Processing ${post.filepath}...`);

      const fileUrl = await readFile(localFilePath);
      const blurhash = await PostRepository.calculateBlurhash(fileUrl);

      // Append to CSV file
      await appendFile(CSV_FILE, `${post.id},${blurhash}\n`);
      console.log(`✓ Generated placeholder for ${post.filepath}: ${blurhash}`);
      results.processed++;
    } catch (error) {
      const errorMessage =
        error instanceof Error ? error.message : String(error);
      console.error(`✗ Error processing ${post.filepath}:`, errorMessage);
      results.failed++;
      results.errors.push({
        file: post.filepath,
        error: errorMessage,
      });
    }
  }

  console.log(`
    Migration complete:
    - Total files: ${results.total}
    - Processed: ${results.processed}
    - Skipped: ${results.skipped}
    - Failed: ${results.failed}
    - Results saved to: ${CSV_FILE}
  `);

  return results;
});
