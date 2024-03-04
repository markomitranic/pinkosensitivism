import { createClient } from "@libsql/client/web";
import { env } from "~/env";

export const client = createClient({
  url: env.TURSO_DATABASE,
  authToken: env.TURSO_AUTH_TOKEN,
});
