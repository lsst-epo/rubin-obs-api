Cypress.Commands.add("checkUrl", (url) => {
  cy.request({url, failOnStatusCode: false}).its("status").should("equal", 200);
});

Cypress.Commands.add("login", (username, password, saveSession = true) => {
  if (saveSession) {
    cy.session([username, password], () => {
      cy.visit("/login");
      cy.get("#loginName").type(username);
      cy.get("#password").type(password);
      cy.get("#login-form").submit();
      cy.url().should('contain', '/dashboard');
    }, {
      validate() {
        cy.checkUrl("/dashboard");
      },
      cacheAcrossSpecs: true
    });
  } else {
    cy.visit("/login");
    cy.get('#loginName').type(username);
    cy.get('#password').type(password);
    cy.get('#submit').click();
    cy.url().should('contain', '/dashboard');
  }
});