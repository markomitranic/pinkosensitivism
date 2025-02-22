import type { APIRoute } from "astro";
import createHttpError from "http-errors";

/**
 * Wraps a function, adding error handling and response formatting.
 *
 * @example
 * export const GET: APIRoute = ApiRoute(async () => {
 *   if (!env.meta.DEV) throw createHttpError.NotFound();
 *   return BlobStorage.listAllFiles();
 * });
 */
export function ApiRoute<T>(
  callback: (...args: Parameters<APIRoute>) => Promise<T>,
  init?: ResponseInit,
): APIRoute {
  return async (...args) => {
    try {
      const payload = await callback(...args);
      return new Response(
        JSON.stringify({
          success: true,
          timestamp: Date.now(),
          payload,
        }),
        {
          status: 200,
          headers: { "Content-Type": "application/json" },
          ...init,
        },
      );
    } catch (error) {
      // Errors from `http-errors` package.
      if (createHttpError.isHttpError(error)) {
        return new Response(
          JSON.stringify({
            success: false,
            timestamp: Date.now(),
            error: {
              type: "HTTPError",
              name: error.name,
              message: error.message,
              stack: error.stack ? error.stack.split("\n") : undefined,
            },
          }),
          {
            status: error.statusCode,
            headers: { "Content-Type": "application/json" },
          },
        );
      }

      // Generic thrown errors.
      if (error instanceof Error) {
        return new Response(
          JSON.stringify({
            success: false,
            timestamp: Date.now(),
            error: {
              type: "InternalServerError",
              name: error.name,
              message: error.message,
              stack: error.stack ? error.stack.split("\n") : undefined,
            },
          }),
          { status: 500, headers: { "Content-Type": "application/json" } },
        );
      }

      // Should never happen.
      return new Response(
        JSON.stringify({
          success: false,
          timestamp: Date.now(),
          error: {
            type: "UnknownError",
            name: "Error",
            message: JSON.stringify(error),
          },
        }),
        { status: 500, headers: { "Content-Type": "application/json" } },
      );
    }
  };
}
