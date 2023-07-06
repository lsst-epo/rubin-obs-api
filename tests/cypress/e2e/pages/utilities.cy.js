import { checkLinkList } from "./helpers.js";

describe("Utilities pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Utilties
  it("Utilities CP pages exist", () => {
    cy.visit("/utilities");
    checkLinkList(`nav[aria-label="Utilities"] > ul > li > a`);
  });
});
