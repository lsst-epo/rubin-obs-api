import { checkFirstLinkInList } from "./helpers.js";

describe("Assets pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  // Assets
  it("Heroes CP Assets Volume pages exist", () => {
    cy.visit(
      "/assets?site=default&source=volume%3A8e9ec71e-2cf0-4f6a-b856-8976de0ce100"
    );
    checkFirstLinkInList(
      `table[data-name="Assets"] > tbody > tr > th .title a`
    );
  });

  it("Content Images Assets Volume CP pages exist", () => {
    cy.visit(
      "/assets?site=default&source=volume%3Acd6f2275-4f9b-4ba4-aa4c-7c7468366172"
    );
    checkFirstLinkInList(
      `table[data-name="Assets"] > tbody > tr > th .title a`
    );
  });

  it("General Assets Volume CP pages exist", () => {
    cy.visit(
      "/assets?site=default&source=volume%3A18a75c63-648f-4145-9cc3-386e7c8a0106"
    );
    checkFirstLinkInList(
      `table[data-name="Assets"] > tbody > tr > th .title a`
    );
  });

  it("Staff Profiles Assets Volume CP pages exist", () => {
    cy.visit(
      "/assets?site=default&source=volume%3Ac3d1c243-1703-4117-abc7-88487a1f8f24"
    );
    checkFirstLinkInList(
      `table[data-name="Assets"] > tbody > tr > th .title a`
    );
  });

  it("Asset Variants Assets Volume CP pages exist", () => {
    cy.visit(
      "/assets?site=default&source=volume%3Ad41cc960-99a4-41a8-a7a6-7891a22e4a93"
    );
    checkFirstLinkInList(
      `table[data-name="Assets"] > tbody > tr > th .title a`
    );
  });

  it("Temporary Uploads Assets Volume CP pages exist", () => {
    cy.visit(
      "/assets?site=default&source=folder%3Ae398e128-0e76-4d8d-85ee-d96b3c9ed988"
    );
  });
});
