import * as client from "astro:env/client";
import type ServerEnv from "astro:env/server";

/**
 * If we're in SSR, use the real server env.
 * Otherwise, a proxy that throws if you try to access it.
 */
const server = import.meta.env.SSR
  ? await import("astro:env/server")
  : (new Proxy(
      {},
      {
        get(_target, prop) {
          throw new Error(
            `🚨🚨🚨 Accessing SERVER variables in client components is not permitted! Attempted to access: '${String(prop)}'.`,
          );
        },
      },
    ) as typeof ServerEnv);

/**
 * Access validated environment variables.
 *
 * Contains both client and server variables, but will not load the server
 * values when rendering on the client.
 *
 * If server variables are accidentally accessed on the client, it will throw.
 *
 * @example
 * env.server.API_SECRET_KEY
 * env.client.API_URL
 */
export const env = {
  /** Client-only environment variables. */
  client,

  /** Server-only env variables. Will throw if accessed on the client. */
  server,

  /**
   * Vite/Astro's `import.meta.env`. (subset when running on the client)
   * @see https://docs.astro.build/en/guides/environment-variables/#default-environment-variables
   */
  meta: import.meta.env,
} as const;
