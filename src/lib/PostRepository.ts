import { neon } from "@neondatabase/serverless";
import { env } from "~/env";

export type Post = {
  id: string;
  instagram_uuid: string;
  url: string;
  instagram_date: Date;
  modified_at: Date;
};

const sql = neon(env.DATABASE_URL);

export async function getAllPosts() {
  return (await sql`SELECT id, instagram_uuid, url, instagram_date, modified_at  FROM posts;`) as Post[];
}

export async function paginatePosts(page: number, perPage: number) {
  const offset = (page - 1) * perPage;
  return (await sql`SELECT id, instagram_uuid, url, instagram_date, modified_at  FROM posts LIMIT ${perPage} OFFSET ${offset};`) as Post[];
}
