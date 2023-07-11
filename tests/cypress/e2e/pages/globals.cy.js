import { checkLinkList } from "./helpers.js";

describe("Globals pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Globals
  it("Globals CP pages exist", () => {
    cy.visit("/globals");
    checkLinkList(`#sidebar nav > ul > li > a`);
  });
});
