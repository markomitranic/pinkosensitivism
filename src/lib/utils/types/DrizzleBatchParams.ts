import type { db } from "astro:db";

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
