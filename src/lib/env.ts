import * as client from "astro:env/client";
import type ServerEnv from "astro:env/server";

// A fake server env object that throws an error if you try to access it in a client component
let server: typeof ServerEnv = new Proxy(
  {},
  {
    get(_target, prop) {
      throw new Error(
        `🚨🚨🚨 Accessing SERVER variables in client components is not permitted! Attempted to access: '${String(prop)}'.`,
      );
    },
  },
) as typeof ServerEnv;

// If we're in SSR, import the real server env object
if (import.meta.env.SSR) {
  server = await import("astro:env/server");
}

/**
 * A wrapper around validated environment variables.
 *
 * Contains both client and server varibles, but will only load the client values when
 * on the client, as server variables are not available on the client - they will all be undefined.
 *
 * @example
 * console.log(env.server.ALLOW_ROBOTS);
 */
export const env = {
  /**
   * Server-only environment variables.
   * Will be `undefined`, and throw an error if accessed on the client.
   */
  server,
  /**
   * Client-only environment variables.
   */
  client,
} as const;
