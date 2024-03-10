import { createKysely } from "@vercel/postgres-kysely";
import "dotenv/config"; // Ensure env vars are loaded
import { promises as fs } from "fs";
import { FileMigrationProvider, Migrator } from "kysely";
import * as path from "path";
import { fileURLToPath } from "url";
import { env } from "~/env";

const __dirname = path.dirname(fileURLToPath(import.meta.url));
const migrationFolder = path.join(__dirname, "/migrations"); // This needs to be an absolute path.

/**
 * Runs all available migrations in alphabetic order.
 * It uses lock tables to skip over migrations that have already been ran.
 *
 * @see https://kysely.dev/docs/migrations
 * @example pnpm run migrate
 */
async function migrateToLatest() {
  const db = createKysely<unknown>({ connectionString: env.POSTGRES_URL });
  const provider = new FileMigrationProvider({ fs, path, migrationFolder });
  const migrator = new Migrator({ db, provider });

  const migrationFilesCount = Object.keys(
    await provider.getMigrations(),
  ).length;
  console.log(`Total of ${migrationFilesCount} migration files found.`);
  const { error, results } = await migrator.migrateToLatest();
  console.log(`Total of ${results?.length} migration files ran.`);

  results?.forEach((it) => {
    if (it.status === "Success") {
      console.log(`migration "${it.migrationName}" was executed successfully`);
    } else if (it.status === "Error") {
      console.error(`failed to execute migration "${it.migrationName}"`);
    }
  });

  if (error) {
    console.error("failed to migrate");
    console.error(error);
    process.exit(1);
  }

  await db.destroy();
}

await migrateToLatest();
