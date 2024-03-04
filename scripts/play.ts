import { logger } from "./logger";

/**
 * Serves as a playground for quickly iterating on stuff.
 *
 * @example pnpm run cli scripts/play.ts
 */
async function main() {
  await new Promise((resolve) => setTimeout(resolve, 3000));

  logger.success("Success!");
}

void main();
