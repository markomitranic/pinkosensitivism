import { type NextRequest } from "next/server";
import { z, type ZodType } from "zod";

const defaultSchema = z.object({}).passthrough();
type DefaultSchemaType = z.infer<typeof defaultSchema>;

/**
 * Validates the JSON data payload of a `POST` request against a
 * given Zod definition and throws a nice HTTP error if it fails.
 *
 * @example
 * validateRequestParams(req, RequestZod);
 * validateRequestParams(req); // accepts any params
 */
export default async function validateRequestParams<
  Z extends ZodType = typeof defaultSchema,
>(
  request: NextRequest,
  schema?: Z,
): Promise<
  z.SafeParseReturnType<
    Z extends ZodType ? z.infer<Z> : DefaultSchemaType,
    Z extends ZodType ? z.infer<Z> : DefaultSchemaType
  > & { json: unknown }
> {
  const jsonData = (await request.json()) as unknown;
  return {
    ...(schema ?? defaultSchema).safeParse(jsonData),
    json: jsonData,
  };
}
