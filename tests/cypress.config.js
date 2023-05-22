const { defineConfig } = require("cypress");

module.exports = defineConfig({
  e2e: {
    setupNodeEvents(on, config) {
      // implement node event listeners here
    },
  },
  env: {
    TEST_USERNAME: process.env.TEST_USERNAME,
    TEST_PASSWORD: process.env.TEST_PASSWORD,
    CRAFT_DASHBOARD_URL: process.env.CRAFT_DASHBOARD_URL
  }
});
