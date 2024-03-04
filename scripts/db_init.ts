import "dotenv/config"; // Ensure env vars are loaded
import Turso from "~/lib/turso/Turso";
import { logger } from "./logger";

/**
 * @example pnpm tsx ./scripts/db_init.ts
 */
async function main() {
  await Turso.client.execute(`CREATE TABLE IF NOT EXISTS Post (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    instagram_uuid TEXT NOT NULL,
    url TEXT NOT NULL,
    inserted_at TIMESTAMP DEFAULT(STRFTIME('%Y-%m-%d %H:%M:%f', 'NOW'))
  );`);

  await Turso.client.execute(
    `CREATE INDEX IF NOT EXISTS idx_posts_inserted_at ON Post (inserted_at DESC);`,
  );

  logger.success(`Success! Ensured the \`Post\` database is created.`);
}

void main();
