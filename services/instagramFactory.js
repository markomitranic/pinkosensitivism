const { IgApiClient } = require("instagram-private-api");

class InstagramFactory {
  ig;

  /**
   * Creates a logged in instance of IgApiClient.
   * Behaves like a singleton, in case the instance already exists.
   *
   * @param {string} username
   * @param {string} password
   * @returns {Promise<IgApiClient>}
   */
  async get(username, password) {
    if (this.ig) {
      return this.ig;
    }

    this.ig = new IgApiClient();
    this.ig.state.generateDevice(username);
    const user = await this.ig.account.login(username, password);
    return this.ig;
  }
}

const igFactory = new InstagramFactory();

module.exports = { InstagramFactory: igFactory };
