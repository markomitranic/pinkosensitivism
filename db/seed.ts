import { count, db, Posts } from "astro:db";
import { z } from "zod";
import type { DrizzleBatchParams } from "~/lib/utils/types/DrizzleBatchParams";
import seedJson from "./seed.json";

// https://astro.build/db/seed
export default async function seed() {
  // Read JSON seed file.
  const seedPosts = z
    .object({
      instagram_uuid: z.string(),
      filepath: z.string(),
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
