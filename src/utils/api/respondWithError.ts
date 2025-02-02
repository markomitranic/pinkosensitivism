import createHttpError from "http-errors";
import { NextResponse } from "next/server";
import { env } from "~/env";

/**
 * Format and output exceptions into a standardised shape.
 *
 * Meant to be used together with `createHttpError` package.
 *
 * Fallback to a 500 error if we can't properly format it.
 * This is basically an equivalent to a global interceptor,
 * just needs to be used manually.
 *
 * @example
 * try {
 *  throw new createHttpError.MethodNotAllowed(`No method specified on path ${req.url}!`);
 * } catch (e: unknown) {
 *  return respondWithError(e);
 * }
 */
export default function respondWithError(
  err: unknown,
  {
    expose = false,
    headers = {},
  }: {
    expose?: boolean;
    headers?: HeadersInit;
  } = {},
) {
  console.error(err);

  // If we are supposed to expose the error internals, we can just return it as-is.
  if (env.NODE_ENV === "development" || expose === true) {
    if (createHttpError.isHttpError(err)) {
      // Ok, 401 is a special case, we never want to expose it.
      if (err.status === 401) {
        return error(401, { name: err.name, message: err.message }, headers);
      }

      return error(
        err.statusCode,
        {
          name: err.name,
          message: err.message,
          stack: err.stack ? err.stack.split("\n") : undefined,
        },
        headers,
      );
    }

    if (err instanceof Error) {
      return error(
        500,
        {
          name: err.name,
          message: err.message,
          stack: err.stack ? err.stack.split("\n") : undefined,
        },
        headers,
      );
    }

    return error(
      500,
      {
        name: "InternalServerError",
        message: JSON.stringify(err),
      },
      headers,
    );
  }

  // If we aren't supposed to expose the error internals, we will hide them.
  // `http-errors` with statusCode < 500
  if (createHttpError.isHttpError(err) && err.statusCode < 500) {
    return error(err.statusCode, { name: err.name, message: err.message });
  }
  // Default to 500 server error for all other exceptions
  return error(500, {
    name: "InternalServerError",
    message:
      "Internal server error. Please contact support if the issue persists.",
  });
}

function error(
  status: number,
  error: {
    message: string;
    name?: string;
    stack?: string | string[];
  },
  headers: HeadersInit = {},
) {
  return NextResponse.json(
    { status, timestamp: Date.now(), error },
    {
      status,
      headers: {
        "Content-Type": "application/json",
        ...headers,
      },
    },
  );
}
