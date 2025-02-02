/** @typedef {import("prettier").Config} PrettierConfig */
/** @typedef {import("prettier-plugin-tailwindcss").PluginOptions} TailwindConfig */

/** @type { PrettierConfig | TailwindConfig } */
const config = {
  plugins: ["prettier-plugin-tailwindcss"],

  /**
   * Tailwind sorting on component attributes.
   * Same as `.vscode/settings.json:tailwindCSS.classAttributes`
   */
  tailwindAttributes: [
    "className",
    "class",
    "tw",
    "enter",
    "enterFrom",
    "enterTo",
    "leave",
    "leaveFrom",
    "leaveTo",
  ],

  /**
   * Tailwind sorting on function arguments.
   */
  tailwindFunctions: ["twJoin", "twMerge", "cn", "cva", "clsx"],
};

export default config;
