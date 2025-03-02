import { count, db, Posts } from "astro:db";
import { z } from "zod";
import seedJson from "./seed.json";

/**
 * This is a type that represents the parameters of the `db.batch` function.
 *
 * It's a bit of a pain to extract because the `db.batch` function must have at least 1 operation.
 *
 * @example
 * ```ts
 * const queries: DrizzleBatchParams = [
 *   db.select({ count: count() }).from(Posts),
 * ];
 * await db.batch(queries);
 * ```
 */
export type DrizzleBatchParams = [
  Parameters<typeof db.batch>[0][0],
  ...Parameters<typeof db.batch>[0][0][],
];

// https://astro.build/db/seed
export default async function seed() {
  // Read JSON seed file.
  const seedPosts = z
    .object({
      instagram_uuid: z.string(),
      filepath: z.string(),
      blurhash: z.string().optional(),
      posted_at: z.string(),
    })
    .array()
    .parse(seedJson);

  // Prepare statements
  const queries: DrizzleBatchParams = [
    db.select({ count: count() }).from(Posts),
  ];
  for (const post of seedPosts) {
    queries.push(db.insert(Posts).values(post));
  }

  // Execute all queries in one go.
  await db.batch(queries);
}
