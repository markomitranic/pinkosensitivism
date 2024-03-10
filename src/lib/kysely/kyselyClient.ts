import { createKysely } from "@vercel/postgres-kysely";
import { env } from "~/env";
import { type PostTable } from "../domain/PostTable";

export interface Database {
  posts: PostTable;
}

export const kyselyClient = createKysely<Database>({
  connectionString: env.POSTGRES_URL,
});
