const { IgApiClient } = require("instagram-private-api");
const { InstagramFactory } = require("./instagramFactory");
const { DatabaseFactory } = require("./database");
const { Uploads } = require("./uploads");
const { Database } = require("sqlite3");

class InstagramWorker {
  constructor() {
    /**
     * @type {null|number}
     */
    this.intervalId = null;
    /**
     * @type {number}
     */
    this.workerWokeCount = 0;
  }

  async start() {
    if (this.intervalId) {
      console.info(`Already running an interval with ID ${this.intervalId}.`);
      return;
    }

    const fetchInterval = process.env.IG_FETCH_INTERVAL || 86400000; // default: 24h
    const db = await DatabaseFactory.get();
    const ig = await InstagramWorker.getInstagramClient();

    console.info(
      `Starting a new fetch worker on an interval of ${
        fetchInterval / 1000 / 60 / 60
      } h.`
    );
    this.intervalId = setInterval(() => {
      this.work(ig, db);
    }, fetchInterval);

    console.info("Running the work once manually.");
    this.work(ig, db);
  }

  stop() {
    clearInterval(this.intervalId);
    this.intervalId = null;
    this.workerWokeCount = 0;
  }

  /**
   * @param {IgApiClient} ig
   * @param {Database}  db
   */
  async work(ig, db) {
    this.workerWokeCount++;
    console.info(this.workerWokeCount, "Worker cycle started.");

    try {
      const existingPosts = await db.all(
        "SELECT instagram_uuid FROM Post ORDER BY inserted_at DESC LIMIT 1"
      );

      let latestUuid = "full-sync";
      if (existingPosts.length && existingPosts[0].instagram_uuid) {
        latestUuid = existingPosts[0].instagram_uuid;
      }

      const newPosts = await InstagramWorker.getNewPosts(ig, latestUuid);

      newPosts.reverse().forEach(async ({ instagram_uuid, url }) => {
        // Save to disk
        const filePath = Uploads.download(url);

        console.log(
          `INSERT INTO Post (url, instagram_uuid) VALUES ('${filePath}', '${instagram_uuid}')`
        );
        db.exec(
          `INSERT INTO Post (url, instagram_uuid) VALUES ('${filePath}', '${instagram_uuid}')`
        );
      });
    } catch (e) {
      console.error(this.workerWokeCount, `Worker error: ${e}`);
      console.trace();
    } finally {
      console.info(this.workerWokeCount, "Worker cycle ended.");
    }
  }

  /**
   * @param {IgApiClient} ig
   * @param {string} latestUuid
   * @returns {Array<object>}
   */
  static async getNewPosts(ig, latestUuid) {
    const userFeed = ig.feed.user("2966022865");
    const results = [];

    let found = false;
    let requestCounter = 0;
    while (found === false) {
      requestCounter++;
      const response = await userFeed.items();
      console.log(
        `[Request ${requestCounter}] Got ${response.length} rows from Instagram API.`
      );

      for (let i = 0; i < response.length; i++) {
        const post = response[i];
        console.debug(`Index ${i}, comparing ${post.pk} with ${latestUuid}`);
        if (post.pk === latestUuid) {
          console.log(`Matched latest Uuid.`);
          found = true;
          break;
        } else {
          results.push(post);
        }
      }

      // API RATE LIMIT "200 requests an hour"
      if (requestCounter >= process.env.IG_API_RATE) {
        console.log(
          "Breaking the API requests cycle due to hitting the limit."
        );
        break;
      }
    }

    const parsedResults = results.reduce((acc, post) => {
      try {
        let url = "";
        switch (post.media_type) {
          case 1:
            url = post.image_versions2.candidates[0].url;
            break;
          default:
            url = post.carousel_media[0].image_versions2.candidates[0].url;
        }
        acc.push({ instagram_uuid: post.pk, url });
      } catch (e) {
        console.error(
          "Post has no image versions. Dropping from results.",
          JSON.stringify(post),
          e
        );
      } finally {
        return acc;
      }
    }, []);

    console.log(`Found ${parsedResults.length} new posts.`);
    return parsedResults;
  }

  static async getInstagramClient() {
    console.info(`Constructing IG login.`);
    const username = process.env.IG_USERNAME;
    const password = process.env.IG_PASSWORD;
    return await InstagramFactory.get(username, password);
  }
}

module.exports = { InstagramWorker };
