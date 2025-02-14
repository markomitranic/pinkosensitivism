import react from "@astrojs/react";
import solid from "@astrojs/solid-js";
import vercel from "@astrojs/vercel";
import tailwindcss from "@tailwindcss/vite";
import astroDevToolBreakpoints from "astro-devtool-breakpoints";
import { defineConfig, envField } from "astro/config";
import path from "path";

/** @see https://astro.build/config */
export default defineConfig({
  adapter: vercel(),
  integrations: [
    astroDevToolBreakpoints(),
    react({ include: ["**/*.react.tsx"] }),
    solid({ include: ["**/*.solid.tsx"] }),
  ],
  vite: {
    plugins: [tailwindcss()],
    resolve: {
      alias: {
        "~": path.resolve("./src"),
      },
    },
  },
  env: {
    validateSecrets: true,
    schema: {
      ALLOW_CLIENT: envField.boolean({ context: "client", access: "public" }),
      ALLOW_ROBOTS: envField.boolean({ context: "server", access: "public" }),
      DATABASE_URL: envField.string({ context: "server", access: "secret" }),
      BLOB_READ_WRITE_TOKEN: envField.string({
        context: "server",
        access: "secret",
      }),
      INSTAGRAM_API_TOKEN: envField.string({
        context: "server",
        access: "secret",
      }),
    },
  },
});
