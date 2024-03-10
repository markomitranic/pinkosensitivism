import dayjs from "dayjs";
import "dotenv/config"; // Ensure env vars are loaded
import Posts from "~/lib/kysely/posts";
import { type Post } from "~/lib/turso/Post";
import { client as TursoClient } from "~/lib/turso/client";
import { logger } from "./logger";

/**
 * A One-time script used to codify migration logic
 * when switching from Turso to Vercel's psql.
 *
 * @example pnpm run cli scripts/migrate_turso_to_vercel.ts
 */
async function main() {
  let offset = 0;
  const limit = 50; // fetch in chunks

  while (true) {
    let hasData = false;
    for await (const post of list(limit, offset)) {
      hasData = true;
      await Posts.create({
        ...post,
        instagram_date: dayjs(post.inserted_at).toDate(),
      });
    }

    if (!hasData) break; // exit the loop if no more data
    offset += limit; // increase the offset for the next chunk
  }

  logger.success("Success!");
  process.exit(0);
}

void main();

async function* list(limit: number, offset: number) {
  const { rows } = await TursoClient.execute({
    sql: `SELECT id, instagram_uuid, url, inserted_at FROM Post ORDER BY inserted_at DESC LIMIT :limit OFFSET :offset`,
    args: { limit, offset },
  });

  for (const row of rows) {
    yield row as unknown as Post;
  }
}
