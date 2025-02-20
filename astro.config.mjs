import react from "@astrojs/react";
import solid from "@astrojs/solid-js";
import vercel from "@astrojs/vercel";
import tailwindcss from "@tailwindcss/vite";
import { defineConfig, envField } from "astro/config";
import path from "path";

/** @see https://astro.build/config */
export default defineConfig({
  adapter: vercel(),
  integrations: [
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
  image: {
    domains: ["pinkosensitivism.com"],
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
      // S3/R2 Configuration
      S3_ENDPOINT: envField.string({
        context: "server",
        access: "secret",
        description: "Cloudflare R2 endpoint URL",
      }),
      S3_ACCESS_KEY_ID: envField.string({
        context: "server",
        access: "secret",
        description: "Cloudflare R2 access key ID",
      }),
      S3_SECRET_ACCESS_KEY: envField.string({
        context: "server",
        access: "secret",
        description: "Cloudflare R2 secret access key",
      }),
      S3_BUCKET_NAME: envField.string({
        context: "server",
        access: "secret",
        description: "Cloudflare R2 bucket name",
      }),
      S3_PUBLIC_URL: envField.string({
        context: "client",
        access: "public",
        description: "Public URL for accessing S3/R2 objects",
      }),
    },
  },
});
