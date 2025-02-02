import createHttpError from "http-errors";
import { type ZodError } from "zod";
import { generateErrorMessage } from "zod-error";
import respondWithError from "./respondWithError";

/**
 * Format and output exceptions into a standardised shape.
 *
 * @example
 * respondWithZodError(e);
 */
export default function respondWithZodError(error: ZodError) {
  console.error(error); // easier to read
  return respondWithError(
    createHttpError.BadRequest(
      `Request Validation Error: ${generateErrorMessage(error.issues)}`,
    ),
  );
}
