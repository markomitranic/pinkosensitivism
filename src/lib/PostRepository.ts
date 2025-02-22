import { db, desc, Posts } from "astro:db";
import { BlobStorage } from "./BlobStorage";
import { filterNotEmpty } from "./utils/tooling/filterNotEmpty";

export const PostRepository = {
  async all() {
    const posts = await db.select().from(Posts).orderBy(desc(Posts.posted_at));
    return posts
      .map((post) => BlobStorage.getPublicStorageUrl(post.filepath))
      .filter(filterNotEmpty);
  },
};
