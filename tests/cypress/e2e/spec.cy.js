// require('dotenv').config({ path: './.env' });
// console.log("Logging process.env globally:");
// console.log(process.env);

Cypress.Commands.add('login', (username, password, loginUrl) => {
  cy.visit(loginUrl)
  cy.get('#loginName').type(username)
  cy.get('#password').type(password)
  cy.get('#submit').click()
  cy.url().should('contain', '/dashboard')
})

describe("Testing Craft Dashboard", () => {
  beforeEach(() => {
    // require('dotenv').config({ path: './.env' });
    Cypress.log({
      name: "test",
      message: "hello hello!"
    });
    console.log("Logging process.env within beforeEach():");
    console.log(process.env);

    cy.login(process.env.TEST_USERNAME, process.env.TEST_PASSWORD, process.env.CRAFT_DASHBOARD_URL)
  });

  it("should navigate to navbar links 1x1", () => {
      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-entries a").click();
      cy.url().should("include", "entries");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-globals a").click();
      cy.url().should("include", "globals");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-categories a").click();
      cy.url().should("include", "categories");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-assets a").click();
      cy.url().should("include", "assets");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-users a").click();
      cy.url().should("include", "user");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-graphql a").click();
      cy.url().should("include", "graphql");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-utilities a").click();
      cy.url().should("include", "utilities");
      cy.go("back").end();

      cy.get("#primary-nav-toggle").should("be.visible").click();
      cy.get("#nav-settings a").click();
      cy.url().should("include", "settings");
      cy.go("back").end();
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
    cy.url().should("include", "/users/all").end();
  });
  
});
