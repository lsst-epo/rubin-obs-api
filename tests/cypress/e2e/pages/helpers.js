// Helper Methods
export const checkLinkList = (selector) => {
  cy.get(selector).each((link) => {
    cy.checkUrl(link.prop("href"));
  });
};

export const checkFirstLinkInList = (selector) => {
  cy.get(selector)
    .first()
    .then(($el) => {
      cy.checkUrl($el.attr("href"));
    });
};

// Batch Tests
export const checkPages = (root, types) => {
  function capitalize(word) {
    return word.charAt(0).toUpperCase() + word.slice(1);
  }

  types.forEach((type) => {
    it(`${capitalize(type)} CP pages exist`, () => {
      cy.visit(`/${root}/${type}`);
      checkFirstLinkInList(
        `table[data-name="${capitalize(root)}"] > tbody > tr > th .title a`
      );
    });
  });
};
