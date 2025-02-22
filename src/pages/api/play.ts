import { count, db, Posts } from "astro:db";
import createHttpError from "http-errors";
import { env } from "~/lib/env";
import { ApiRoute } from "~/lib/utils/ApiRoute";

/**
 * Used as a dev playground.
 * @see http://localhost:3000/api/play/
 *
 * @example
 * ```bash
 * curl -s http://localhost:3000/api/play/ | json_pp
 * ```
 */

export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  return {
    count: (await db.select({ count: count() }).from(Posts))[0].count,
    items: await db.select().from(Posts),
  };
});
