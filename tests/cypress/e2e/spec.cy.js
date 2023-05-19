require('dotenv').config();
console.log("Logging process.env globally:");
console.log(process.env);

Cypress.Commands.add('login', (username, password, loginUrl) => {
  cy.visit(loginUrl)
  cy.get('#loginName').type(username)
  cy.get('#password').type(password)
  cy.get('#submit').click()
  cy.url().should('contain', '/dashboard')
})

describe("Testing Craft Dashboard", () => {
  beforeEach(() => {
    require('dotenv').config();
    console.log("Logging process.env within beforeEach():");
    console.log(process.env);

    cy.login("temp_test", "testertester", "https://preview_epo-7941-dot-rubin-obs-api-dot-skyviewer.uw.r.appspot.com/admin/login")
  });

  it("should navigate to navbar links 1x1", () => {
      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-entries a").click();
      cy.url().should("include", "entries");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-globals a").click();
      cy.url().should("include", "globals");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-categories a").click();
      cy.url().should("include", "categories");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-assets a").click();
      cy.url().should("include", "assets");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-users a").click();
      cy.url().should("include", "user");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-graphql a").click();
      cy.url().should("include", "graphql");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-utilities a").click();
      cy.url().should("include", "utilities");
      cy.go("back");

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-settings a").click();
      cy.url().should("include", "settings");
      cy.go("back");
  });

  it("should create user", () => {
    const guid = Date.now();
    cy.get("#primary-nav-toggle").should("be.visible").click();
    cy.get("#nav-users a").click();
    cy.url().should("include", "user");

    cy.get("#action-buttons a").click();

    cy.url().should("include", "new");
    cy.get("#username").type(`new-user-${guid}`);
    cy.get("#fullName").type("New User");
    cy.get("#email").type(`fake-${guid}@email.adr`);

    cy.get("#action-buttons .formsubmit").click();
    cy.url().should("include", "/users/all");
  });
  
});
