import { PrismaClient, type Post } from "@prisma/client";
import "dotenv/config";
import { open } from "sqlite";
import sqlite3 from "sqlite3";

type SqlitePost = {
  instagram_uuid: string;
  url: string;
  inserted_at: string;
};

const prisma = new PrismaClient();

const db = await open({
  filename: "./database.db",
  driver: sqlite3.Database,
});

/**
 * Used to read the Sqlite file from the old setup and add the entries
 * into the new Postgres database.
 *
 * It performs an in-memory deduplication of the incoming posts.
 *
 * @example pnpm tsx ./scripts/migrate_sqlite.ts
 */
async function main() {
  const oldPosts = await db.all<SqlitePost[]>(
    "SELECT instagram_uuid, url, inserted_at FROM Post ORDER BY inserted_at DESC",
  );

  const posts = new Map<string, Omit<Post, "id">>();

  for (const oldPost of oldPosts) {
    if (!posts.has(oldPost.instagram_uuid)) {
      posts.set(oldPost.instagram_uuid, {
        instagramId: oldPost.instagram_uuid,
        url: oldPost.url,
        createdAt: new Date(oldPost.inserted_at),
      });
    }
  }

  await prisma.post.createMany({
    data: Array.from(posts, ([_key, value]) => value),
  });

  console.log(`Success! ${await prisma.post.count()} posts inserted.`);
}

void main();
