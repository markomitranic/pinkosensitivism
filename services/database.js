const sqlite3 = require("sqlite3");
const { Database } = require("sqlite3");
const { open } = require("sqlite");

class DatabaseFactory {
  constructor() {
    /**
     * @type {null|Database}
     */
    this.db = null;
  }

  /**
   * @param {string} filePath
   * @returns {Promise<Database>}
   */
  async get() {
    if (this.db) {
      return this.db;
    }

    this.db = await open({
      filename: process.env.SQLITE_DB_FILEPATH,
      driver: sqlite3.Database,
    });
    await this.db.migrate();
    return this.db;
  }
}

const dbFactory = new DatabaseFactory();

module.exports = { DatabaseFactory: dbFactory };
