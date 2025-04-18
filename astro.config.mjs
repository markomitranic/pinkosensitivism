import db from "@astrojs/db";
import vercel from "@astrojs/vercel";
import tailwindcss from "@tailwindcss/vite";
import { imageService } from "@unpic/astro/service";
import { defineConfig, envField } from "astro/config";
import path from "path";

/** @see https://astro.build/config */
export default defineConfig({
  adapter: vercel({
    imageService: true,
    devImageService: "sharp",
    imagesConfig: {
      domains: ["pinkosensitivism.com", "storage.pinkosensitivism.com"],
      minimumCacheTTL: 31536000,
      sizes: [250, 500],
    },
  }),
  integrations: [db()],
  vite: {
    plugins: [tailwindcss()],
    resolve: {
      alias: {
        "~": path.resolve("./src"),
      },
    },
  },
  image: {
    service: imageService(),
    domains: ["pinkosensitivism.com", "storage.pinkosensitivism.com"],
  },
  env: {
    validateSecrets: true,
    schema: {
      // Image Blob Storage
      S3_ENDPOINT: envField.string({
        context: "server",
        access: "secret",
      }),
      S3_ACCESS_KEY_ID: envField.string({
        context: "server",
        access: "secret",
      }),
      S3_SECRET_ACCESS_KEY: envField.string({
        context: "server",
        access: "secret",
      }),
      S3_BUCKET_NAME: envField.string({
        context: "server",
        access: "secret",
      }),
      S3_PUBLIC_URL: envField.string({
        context: "client",
        access: "public",
      }),
      // SQLite Database
      ASTRO_DB_REMOTE_URL: envField.string({
        context: "server",
        access: "secret",
      }),
      ASTRO_DB_APP_TOKEN: envField.string({
        context: "server",
        access: "secret",
      }),
      // Instagram API
      INSTAGRAM_API_TOKEN: envField.string({
        context: "server",
        access: "secret",
      }),
    },
  },
});
