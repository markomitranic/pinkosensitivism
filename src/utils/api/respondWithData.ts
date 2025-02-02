import { NextResponse } from "next/server";
import { type z } from "zod";

type ResponseData = Record<string, unknown> | undefined;

type ApiResponse<Data extends ResponseData> = {
  status: number;
  timestamp: number;
  data: Data;
};

export type DataApi<Input extends z.ZodType, Data extends ResponseData> = (
  params: z.infer<Input>,
) => Promise<ApiResponse<Awaited<Data>>>;

/**
 * Creates a response object in a standardised envelope.
 *
 * @example
 * respondWithData({ foo: "bar" });
 * { status: 200, timestamp: 1712325980344, data: { foo: "bar"} }
 *
 * // Usage in context
 * try {
 *  return respondWithData({ foo: "bar" });
 * } catch (e: unknown) {
 *  return respondWithError(e);
 * }
 */
export default function respondWithData<
  T extends Record<string, unknown> | undefined,
>(
  data: T,
  {
    status = 200,
    headers = {},
  }: {
    status?: number;
    headers?: HeadersInit;
  } = {},
) {
  return NextResponse.json(
    {
      status,
      timestamp: Date.now(),
      data,
    } satisfies ApiResponse<T>,
    {
      status,
      headers: {
        "Content-Type": "application/json",
        ...headers,
      },
    },
  );
}
