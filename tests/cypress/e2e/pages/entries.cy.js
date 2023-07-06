import { checkPages } from "./helpers.js";

describe("Entries pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Visits Entry type landing page + first entry page in the list of entries: expects 200s from each request
  checkPages("entries", ["callouts", "events", "galleryItems", "investigations", "jobs", "news", "slideshows", "staffProfiles", "pages"]);
});
