import { kyselyClient } from "./kyselyClient";

export default abstract class Posts {
  public static async list(offset: number, limit: number) {
    return kyselyClient
      .selectFrom("posts")
      .select(["id", "instagram_date", "instagram_uuid", "url"])
      .orderBy("instagram_date desc")
      .offset(offset)
      .limit(limit)
      .execute();
  }

  public static async get(id: number) {
    return kyselyClient
      .selectFrom("posts")
      .select(["id", "instagram_date", "instagram_uuid", "url"])
      .where("id", "=", id)
      .executeTakeFirstOrThrow();
  }

  public static async create({
    instagram_uuid,
    instagram_date,
    url,
  }: {
    instagram_uuid: string;
    url: string;
    instagram_date: Date;
  }) {
    return await kyselyClient
      .insertInto("posts")
      .values({
        instagram_uuid,
        instagram_date,
        url,
      })
      .executeTakeFirstOrThrow();
  }
}
