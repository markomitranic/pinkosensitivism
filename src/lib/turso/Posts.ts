import { z } from "zod";
import { type Post } from "./Post";
import { client } from "./client";

export default abstract class Posts {
  public static async list(offset: number, limit: number) {
    const { rows } = await client.execute({
      sql: `SELECT id, instagram_uuid, url, inserted_at FROM Post ORDER BY inserted_at DESC LIMIT :limit OFFSET :offset`,
      args: { limit, offset },
    });

    return rows.map((row) => {
      return z
        .object({
          id: z.string(),
          instagram_uuid: z.string(),
          url: z.string(),
          inserted_at: z.string(),
        })
        .parse({
          id: row[0]?.toString(),
          instagram_uuid: row[1],
          url: row[2],
          inserted_at: row[3],
        });
    });
  }

  public static async get(id: bigint | number | string): Promise<Post> {
    const {
      rows: [result],
    } = await client.execute({
      sql: "SELECT id, instagram_uuid, url, inserted_at FROM Post WHERE id = ?",
      args: [id],
    });

    if (!result) throw Error("Post cannot be found.");

    return z
      .object({
        id: z.string(),
        instagram_uuid: z.string(),
        url: z.string(),
        inserted_at: z.string(),
      })
      .parse({
        id: result[0]?.toString(),
        instagram_uuid: result[1],
        url: result[2],
        inserted_at: result[3],
      });
  }

  /**
   * Creates a new post from a given changeset.
   */
  public static async create({
    instagram_uuid,
    url,
    inserted_at,
  }: Omit<Post, "id">) {
    const response = await client.execute({
      sql: "INSERT INTO Post (instagram_uuid, url, inserted_at) VALUES (?, ?, ?)",
      args: [instagram_uuid, url, inserted_at],
    });

    if (response.rowsAffected !== 1 || !response.lastInsertRowid)
      throw Error(
        `Post creation resulted in no rows changed: ${JSON.stringify(response)}`,
      );

    return await Posts.get(response.lastInsertRowid);
  }
}
