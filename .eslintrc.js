module.exports = {
  root: true,
  env: {
    browser: true,
  },
  rules: {
    "array-callback-return": 0,
    "arrow-body-style": 0,
    "global-require": 0,
    "consistent-return": 0,
    "prefer-template": 0,
    "no-useless-constructor": 0,
    quotes: 0,
    "jsx-quotes": 2,
    "block-scoped-var": 0,
    "comma-dangle": 0,
    "comma-spacing": 2,
    "generator-star-spacing": 0,
    indent: 0,
    "no-alert": 2,
    "no-console": [
      "error",
      {
        allow: ["warn", "error", "info"],
      },
    ],
    "no-debugger": 2,
    semi: 0,
    "no-empty-pattern": 1,
    "no-extra-semi": 0,
    "no-unused-semi": 0,
    "no-unused-vars": [
      0,
      {
        args: "after-used",
        varsIgnorePattern: "PropTypes",
        argsIgnorePattern: "[iI]gnored",
      },
    ],
    "no-trailing-spaces": 2,
    "no-multiple-empty-lines": 2,
    "no-underscore-dangle": 0,
    "max-len": [
      "error",
      {
        ignoreComments: true,
        ignoreStrings: true,
        ignoreTemplateLiterals: true,
      },
    ],
    "padded-blocks": 0,
    "prefer-const": 2,
    "space-before-function-paren": 0,
    "spaced-comment": 2,
    "unused-imports/no-unused-imports": 2,
  },
  plugins: ["unused-imports", "promise"],
  extends: ["standard", "prettier", "plugin:cypress/recommended"],
};