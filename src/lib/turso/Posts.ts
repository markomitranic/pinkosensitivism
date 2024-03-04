import { type Post } from "./Post";
import { client } from "./client";

export default abstract class Posts {
  public static async getAll() {
    const posts = await client.execute(
      "SELECT * FROM Post ORDER BY insertedAt DESC",
    );
    return posts;
  }

  public static async get(id: bigint) {
    return await client.execute({
      sql: "SELECT * FROM Post WHERE id = ?",
      args: [id],
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
