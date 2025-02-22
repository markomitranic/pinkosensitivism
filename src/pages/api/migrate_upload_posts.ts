import fs from "fs";
import createHttpError from "http-errors";
import path from "path";
import { BlobStorage } from "~/lib/BlobStorage";
import { env } from "~/lib/env";
import { ApiRoute } from "~/lib/utils/ApiRoute";

/**
 * Migrates all PNG files from the posts directory to S3.
 * Only available in development mode.
 *
 * @see http://localhost:3000/api/migrate_upload_posts/
 *
 * @example
 * ```bash
 * curl -s http://localhost:3000/api/migrate_upload_posts/ | json_pp
 * ```
 */
export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  const postsDir = path.join(process.cwd(), "posts");
  const files = await fs.promises.readdir(postsDir);
  const pngFiles = files.filter((file) => file.endsWith(".png"));

  console.log(`Starting migration of ${pngFiles.length} files...`);

  const results = {
    total: pngFiles.length,
    uploaded: 0,
    skipped: 0,
    failed: 0,
    errors: [] as Array<{ file: string; error: string }>,
  };

  // Get list of existing files
  const existingFiles = await BlobStorage.listAllFiles();
  const existingKeys = new Set(existingFiles.map((file) => file.Key));

  for (const file of pngFiles) {
    try {
      // Check if file already exists
      if (existingKeys.has(file)) {
        console.log(`Skipping ${file} - already exists in S3`);
        results.skipped++;
        continue;
      }

      console.log(`Starting upload of ${file}...`);
      await BlobStorage.uploadFile(`posts/${file}`);
      console.log(`✓ Finished uploading ${file}`);
      results.uploaded++;
    } catch (error) {
      console.error(
        `✗ Error uploading ${file}:`,
        error instanceof Error ? error.message : error,
      );
      results.failed++;
      results.errors.push({
        file,
        error: error instanceof Error ? error.message : String(error),
      });
    }
  }

  console.log(`
    Migration complete:
    - Total files: ${results.total}
    - Uploaded: ${results.uploaded}
    - Skipped: ${results.skipped}
    - Failed: ${results.failed}
  `);

  return results;
});
