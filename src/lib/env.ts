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

export const env = {
  server,
  client,
} as const;
