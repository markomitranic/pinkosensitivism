import { PrismaClient } from "@prisma/client";
import "dotenv/config";
import { dbg } from "~/lib/utils/dbg";

const prisma = new PrismaClient();

/**
 * Serves as a playground for quickly iterating on stuff.
 *
 * @example pnpm tsx ./scripts/play.ts
 */
async function main() {
  dbg(await prisma.post.count());

  console.log("Success!");
}

void main();