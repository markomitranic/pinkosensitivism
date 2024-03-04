import "dotenv/config"; // Ensure env vars are loaded
import { open } from "sqlite";
import sqlite3 from "sqlite3";
import Turso from "~/lib/turso/Turso";
import { logger } from "./logger";

type SqlitePost = {
  instagram_uuid: string;
  url: string;
  inserted_at: string;
};

/**
 * Used to read the Sqlite file from the old setup and add the entries
 * into the new Postgres database.
 *
 * It performs an in-memory deduplication of the incoming posts.
 *
 * @example pnpm cli ./scripts/db_migrate_old.ts
 */
async function main() {
  const db = await open({
    filename: "./database.db",
    driver: sqlite3.Database,
  });
  const oldPosts = await db.all<SqlitePost[]>(
    "SELECT instagram_uuid, url, inserted_at FROM Post ORDER BY inserted_at DESC",
  );

  logger.info("Pushing posts into Turso.");
  for (const post of oldPosts) {
    logger.inline.info(".");
    await Turso.Posts.create(post);
  }
  logger.inline.newline();

  logger.success(`Success!`);
}

void main();
