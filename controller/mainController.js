"use strict";

const { DatabaseFactory } = require("../services/database");

class MainController {
  static async list(req, res, next) {
    this.db = await DatabaseFactory.get();

    const posts = (
      await this.db.all("SELECT url FROM Post ORDER BY inserted_at DESC")
    ).map(({ url }) => {
      return url;
    });

    return {
      pageTitle: "Pinkosensitivism",
      url: "/",
      posts: posts,
      lazyLoadItems: 9,
    };
  }

  static manifesto() {
    return {
      pageTitle: "Pinkosensitivism ~ Manifesto",
      url: "/manifesto",
    };
  }

  static about() {
    return { pageTitle: "Pinkosensitivism ~ About", url: "/about" };
  }
}

module.exports = MainController;
