import { count, db, Posts } from "astro:db";
import { env } from "~/lib/env";

/**
 * Used as a dev playground.
 * @see http://localhost:3000/api/play/
 */
export const GET = async () => {
  if (!env.meta.DEV) return new Response("Not found", { status: 404 });

  try {
    return Response.json({
      count: (await db.select({ count: count() }).from(Posts))[0].count,
      items: await db.select().from(Posts),
    });
  } catch (error) {
    return Response.json(
      {
        name: error instanceof Error ? error.name : "UnknownError",
        message: error instanceof Error ? error.message : JSON.stringify(error),
        stack: error instanceof Error ? error.stack?.split("\n") : undefined,
      },
      { status: 500 },
    );
  }
};
