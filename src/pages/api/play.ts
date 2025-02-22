import createHttpError from "http-errors";
import { z } from "zod";
import posts from "~/../database.json";
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
// eslint-disable-next-line @typescript-eslint/require-await
export const GET = ApiRoute(async () => {
  if (!env.meta.DEV) throw createHttpError.NotFound();

  const validatedPosts = z
    .object({
      id: z.number(),
      instagram_uuid: z.string(),
      url: z.string(),
      inserted_at: z.string(),
    })
    .array()
    .parse(posts);
  return validatedPosts;
});
