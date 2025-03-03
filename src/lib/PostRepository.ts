import { getPixels } from "@unpic/pixels";
import { asc, count, db, Posts } from "astro:db";
import { encode } from "blurhash";
import { BlobStorage } from "./BlobStorage";
import { filterNotEmpty } from "./utils/filterNotEmpty";

const ITEMS_PER_PAGE = 42;

export type PostSrc = {
  url: string;
  blurhash?: string;
};

export const PostRepository = {
  /**
   * Gets the newest posts by fetching from multiple pages.
   * Starts from the last page and works backwards until it has enough posts.
   */
  async getNewestPosts() {
    const lastPage = await getLastPageNumber();
    let currentPage = lastPage;
    let allPosts: PostSrc[] = [];

    // Fetch posts from pages until we have at least ITEMS_PER_PAGE posts or reach the first page
    while (allPosts.length < ITEMS_PER_PAGE && currentPage > 0) {
      const pagePosts = await this.page(currentPage);
      allPosts = [...allPosts, ...pagePosts];
      currentPage--;
    }

    return {
      posts: allPosts,
      nextPage: currentPage - 1,
    };
  },

  /**
   * Gets pages, starting with the oldest posts.
   * Reverses each page, so that the direction of the array is from newest
   * to oldest, because thats how we show it on the page.
   */
  async page(page: number = 1) {
    const cappedPage = page - 1 > 0 ? page - 1 : 0;
    const posts = await db
      .select({
        filepath: Posts.filepath,
        blurhash: Posts.blurhash,
      })
      .from(Posts)
      .orderBy(asc(Posts.posted_at))
      .limit(ITEMS_PER_PAGE)
      .offset(cappedPage * ITEMS_PER_PAGE);

    return posts
      .map((post) => {
        const url = BlobStorage.getPublicStorageUrl(post.filepath);
        if (!url) return;
        return {
          url,
          blurhash: post.blurhash ?? undefined,
        };
      })
      .filter(filterNotEmpty)
      .reverse();
  },
};

async function getLastPageNumber() {
  const result = await db.select({ count: count() }).from(Posts);
  const totalPosts = Number(result[0].count);
  return Math.ceil(totalPosts / ITEMS_PER_PAGE);
}

async function _calculateBlurhash(url: string | Buffer) {
  if (!url) throw new Error("URL is required");
  const imageData = await getPixels(url);
  const data = Uint8ClampedArray.from(imageData.data);
  const blurhash = encode(data, imageData.width, imageData.height, 4, 4);
  return blurhash;
}
