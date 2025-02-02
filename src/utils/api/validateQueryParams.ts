import { type NextRequest } from "next/server";
import { z, type ZodType } from "zod";

const defaultSchema = z.object({}).passthrough();
type DefaultSchemaType = z.infer<typeof defaultSchema>;

/**
 * Validates the query parameters of a `GET` request against a
 * given Zod definition and throws a nice HTTP error if it fails.
 * If no schema is provided, accepts any query parameters.
 *
 * @example
 * validateQueryParams(req, RequestZod);
 * validateQueryParams(req); // accepts any params
 */
export default function validateQueryParams<
  Z extends ZodType = typeof defaultSchema,
>(
  request: NextRequest,
  schema?: Z,
): z.SafeParseReturnType<
  Z extends ZodType ? z.infer<Z> : DefaultSchemaType,
  Z extends ZodType ? z.infer<Z> : DefaultSchemaType
> {
  const jsonData = Object.fromEntries(request.nextUrl.searchParams.entries());
  return (schema ?? defaultSchema).safeParse(jsonData);
}
