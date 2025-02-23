import { getPixels } from "@unpic/pixels";
import { db, desc, Posts } from "astro:db";
import { encode } from "blurhash";
import { BlobStorage } from "./BlobStorage";
import { filterNotEmpty } from "./utils/tooling/filterNotEmpty";

export const PostRepository = {
  async all() {
    const posts = await db.select().from(Posts).orderBy(desc(Posts.posted_at));
    return posts
      .map((post) => {
        const url = BlobStorage.getPublicStorageUrl(post.filepath);
        if (!url) return;
        return {
          url,
          blurhash: post.blurhash ?? undefined,
        };
      })
      .filter(filterNotEmpty);
  },

  async calculateBlurhash(url: string | Buffer) {
    if (!url) throw new Error("URL is required");
    const imageData = await getPixels(url);
    const data = Uint8ClampedArray.from(imageData.data);
    const blurhash = encode(data, imageData.width, imageData.height, 8, 8);
    return blurhash;
  },
};
