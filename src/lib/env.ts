import * as client from "astro:env/client";
import type ServerEnv from "astro:env/server";

/**
 * Cached server environment to avoid recreating it on every access
 */
const serverEnv = await getServerOrProxy();

/**
 * Access validated environment variables.
 *
 * Contains both client and server variables, but will not load the server
 * values when rendering on the client.
 *
 * If server variables are accidentally accessed on the client, it will throw.
 *
 * @example
 * console.log(env.server.ALLOW_ROBOTS);
 */
export const env = {
  /** Client-only environment variables. */
  client,
  /** Server-only env variables. Will throw if accessed on the client. */
  get server() {
    return serverEnv;
  },
  /** @see https://docs.astro.build/en/guides/environment-variables/#default-environment-variables */
  meta: import.meta.env,
} as const;

/**
 * If we're in SSR, return the real server env object.
 * Otherwise, return a proxy that throws if you try to access it.
 */
async function getServerOrProxy() {
  if (import.meta.env.SSR) return await import("astro:env/server");

  /** A fake server object that throws if you try to access it. */
  return new Proxy(
    {},
    {
      get(_target, prop) {
        throw new Error(
          `🚨🚨🚨 Accessing SERVER variables in client components is not permitted! Attempted to access: '${String(prop)}'.`,
        );
      },
    },
  ) as typeof ServerEnv;
}
