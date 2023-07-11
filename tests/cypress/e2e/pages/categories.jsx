import { checkPages } from "./helpers.js";

describe("Category pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Visits each Category landing page + first category page in the list: expects 200s from each request
  checkPages("categories", [
    "eventFilters",
    "galleryTypes",
    "jobTypes",
    "location",
    "newsFilters",
    "sortOptions",
    "staffFilters",
  ]);
});
