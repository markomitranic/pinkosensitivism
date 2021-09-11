"use strict";
var fs = require("fs"),
  request = require("request"),
  crypto = require("crypto");

class Uploads {
  /**
   * @param {string} uri
   * @returns {string}
   */
  static download(uri) {
    const relativeFilePath = `posts/${crypto.randomUUID()}.png`;
    const absoluteFilePath = `${process.cwd()}/public/${relativeFilePath}`;

    request.head(uri, function (err, res, body) {
      request(uri)
        .pipe(fs.createWriteStream(absoluteFilePath))
        .on("close", () => {
          console.log(`Downloaded ${absoluteFilePath}.`);
        });
    });
    return relativeFilePath;
  }
}

module.exports = { Uploads };
