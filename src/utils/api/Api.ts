import createHttpError from "http-errors";
import { notFound } from "next/navigation";
import { env } from "~/env";
import { parseResponse } from "./parseResponse";
import respondWithData from "./respondWithData";
import respondWithError from "./respondWithError";
import respondWithList from "./respondWithList";
import respondWithRedirect from "./respondWithRedirect";
import respondWithStream from "./respondWithStream";
import respondWithZodError from "./respondWithZodError";
import { validateBearer } from "./validateBearer";
import validateQueryParams from "./validateQueryParams";
import validateRequestParams from "./validateRequestParams";

/**
 * A barrel export of HTTP-API-related utilities.
 *
 * Just a set of useful functions for common operations.
 */
const Api = {
  /** Returns a 404 error if `NODE_ENV` not in development mode. */
  allowedOnlyInDev() {
    if (env.NODE_ENV === "development") return;
    return notFound();
  },
  respondWithError,
  respondWithZodError,
  respondWithData,
  respondWithStream,
  respondWithList,
  respondWithRedirect,
  validateBearer,
  validateQueryParams,
  validateRequestParams,
  parseResponse,

  /**
   * Creates and returns a proper HTTP error based
   * on `http-errors` package.
   *
   * @see https://github.com/jshttp/http-errors#list-of-all-constructors
   *
   * @example
   * throw Api.error.NotAcceptable()
   */
  error: createHttpError,
};

export default Api;
