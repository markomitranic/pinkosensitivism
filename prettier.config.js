/** @type {import('postcss-load-config').Config} */
const config = {
  plugins: {
    tailwindcss: {},
  },

   /**
   * Tailwind sorting on component attributes.
   * Same as `.vscode/settings.json:tailwindCSS.classAttributes`
   */
   tailwindAttributes: [
    "className",
    "class",
  ],

  /**
   * Tailwind sorting on function arguments.
   */
  tailwindFunctions: ["cn"],
};

export default config;
