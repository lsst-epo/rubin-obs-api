import { checkUrl } from "./helpers.js";

describe("Top Level Control Panel pages", () => {
  beforeEach(() => {
    cy.login(Cypress.env("TEST_USERNAME"), Cypress.env("TEST_PASSWORD"), true);
  });

  it("Top Level CP pages exist", () => {
    // Dashboard 
    cy.checkUrl('/dashboard');
    
    // Entries 
    cy.checkUrl('/entries');
        
    // Globals 
    cy.checkUrl('/globals');
            
    // Categories 
    cy.checkUrl('/categories');
                
    // Assets 
    cy.checkUrl('/assets');
                    
    // Users 
    cy.checkUrl('/users/all');
                        
    // GraphQL 
    cy.checkUrl('/graphql/schemas');
    
    // Utilties
    cy.checkUrl("/utilities");
  });
});
