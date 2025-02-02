import { NextResponse } from "next/server";

/**
 * Creates a stream response object in a standardised envelope.
 *
 * @example
 * respondWithStream(generator);
 * { status: 200, timestamp: 1712325980344, data: [ 1, ...2, ...3] }
 *
 * // Attach metadata
 * respondWithStream(generator, { foo: "bar" });
 * { status: 200, timestamp: 1712325980344, metadata: { foo: "bar" }, data: [ 1, ...2, ...3] }
 *
 * // Usage with a test generator
 * async function* generator() {
 *   for (let i = 0; i < 6; i++) {
 *     await sleep(1_000);
 *     yield { foo: "bar" };
 *   }
 * }
 * respondWithStream(generator);
 */
export default function respondWithStream<G extends AsyncGenerator>(
  generator: G,
  metadata: Record<string, unknown> = {},
  {
    status = 200,
    headers = {},
  }: {
    status?: number;
    headers?: HeadersInit;
  } = {},
) {
  const readableStream = new ReadableStream({
    async start(controller) {
      controller.enqueue(
        `{
          "status":${status},
          "timestamp": ${Date.now()},
          "metadata": ${JSON.stringify(metadata)},
          "data": [`,
      );
      let first = true;
      for await (const submission of generator) {
        if (!first) {
          controller.enqueue(",");
        }
        first = false;
        controller.enqueue(JSON.stringify(submission));
      }

      controller.enqueue("] }");
      controller.close();
    },
  });

  return new NextResponse(readableStream, {
    status,
    headers: {
      "Content-Type": "application/json",
      ...headers,
    },
  });
}
