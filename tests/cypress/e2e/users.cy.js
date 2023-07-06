// Does not consistently find new user in list of all users.

describe("Users", () => {
  const guid = Date.now();
  const userName = `new-user-${guid}`;
  const fullName = "New User";
  const email = `fake-${guid}@email.adr`;

  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true)
  });

  it("should create and then delete user", () => {
    cy.visit("/users/all");

    cy.get(`a[href*="users/new"]`).click();
    cy.get("#username").type(userName);
    cy.get("#fullName").type(fullName);
    cy.get("#email").type(email);
    cy.get("#userform").submit();

    cy.url().should("contain", "users/all");
    cy.visit("/users/all?site=default&source=*&sort=dateCreated-desc");

    cy.get(`table[data-name="Users"]`).contains(guid);
    cy.get(`table[data-name="Users"] > tbody > tr:first-child > td:first-child > .checkbox`).click();
    cy.get("form > .btn").click();
    cy.get("#craft-elements-actions-DeleteUsers-actiontrigger").click();
    cy.get(`.deleteusermodal input[value="delete"]`).click();
    cy.get(`.deleteusermodal button[type="submit"]`).click();

    cy.url().should("contain", "users/all");
    cy.visit("/users/all?site=default&source=*&sort=dateCreated-desc");
    cy.get(`table[data-name="Users"]`).should("not.contain", guid);
  });
});
