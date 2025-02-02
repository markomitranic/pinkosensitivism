import createHttpError from "http-errors";
import { parseResponse } from "./parseResponse";
import respondWithData from "./respondWithData";
import respondWithError from "./respondWithError";
import respondWithList from "./respondWithList";
import respondWithZodError from "./respondWithZodError";
import validateQueryParams from "./validateQueryParams";
import validateRequestParams from "./validateRequestParams";

/**
 * A barrel export of HTTP-API-related utilities.
 *
 * Just a set of useful functions for common operations.
 */
const Api = {
  respondWithError,
  respondWithZodError,
  respondWithData,
  respondWithList,
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
