import createHttpError from "http-errors";
import { BlobStorage } from "~/lib/BlobStorage";
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
  return BlobStorage.listAllFiles();
});
