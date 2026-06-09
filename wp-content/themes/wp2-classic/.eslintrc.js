module.exports = {
    extends: 'eslint:recommended',
    parserOptions: {
      ecmaVersion: 2020,
      sourceType: 'module',
    },
    env: {
      browser: true,
      node: true,
      es2020: true,
    },
    rules: {
      'no-console': 'warn',
      'no-unused-vars': 'error',
    },
  };
  