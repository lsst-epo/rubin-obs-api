import { checkPages } from "./helpers.js";

describe("User pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Visits each Users landing page + first user page in the list: expects 200s from each request
  checkPages("users", [
    "admins",
    "credentialed",
    "editors",
    "educators",
    "students",
  ]);
});
