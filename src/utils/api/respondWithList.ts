import { NextResponse } from "next/server";
import { type z } from "zod";

type ResponseData = Array<unknown>;

type ApiListResponse<Data extends ResponseData> = {
  status: number;
  timestamp: number;
  meta: {
    totalCount: number;
    currentPage: number;
    totalPages: number;
  };
  data: Data;
};

export type ListApi<Input extends z.ZodType, Data extends ResponseData> = (
  params: z.infer<Input>,
) => Promise<ApiListResponse<Awaited<Data>>>;

/**
 * Creates a response object that represents a list
 * in a standardised envelope.
 *
 * @example
 * try {
 *  return respondWithList([1, 2, 3]);
 * } catch (e: unknown) {
 *  return respondWithError(e);
 * }
 */
export default function respondWithList<D extends Array<unknown>>(
  data: D,
  opts: {
    currentPage?: number;
    totalPages?: number;
    status?: number;
    totalCount?: number;
    headers?: HeadersInit;
  } = {},
) {
  const {
    currentPage,
    totalPages,
    status = 200,
    headers = {},
    totalCount,
  } = {
    currentPage: opts?.currentPage ?? 1,
    totalPages: opts?.totalPages ?? 1,
    status: opts?.status ?? 200,
    totalCount: opts?.totalCount ?? data.length,
  };

  return NextResponse.json(
    {
      status,
      timestamp: Date.now(),
      meta: { totalCount, currentPage, totalPages },
      data,
    } satisfies ApiListResponse<D>,
    {
      status,
      headers: {
        "Content-Type": "application/json",
        ...headers,
      },
    },
  );
}
