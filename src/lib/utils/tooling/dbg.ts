// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { type inspect } from "util";

/**
 * Pretty-prints the given arguments into the console, by deeply unwrapping
 * stringified objects with indentation.
 *
 * @warning This is a debugging tool, and should not be used in production.
 *
 * @see {@link inspect} Similar,more powerful, built-in alternative,
 * that is a bit harder to use in daily life.
 *
 * @example
 * dbg(123)
 * [123]
 *
 * dbg("test", 123)
 * ["test", 123]
 *
 * dbg("test", { id: 1, cta: { label: "Click", url: "#"} })
 * ["test", ```{
 *  "id": 1,
 *  "cta": {
 *      "label": "Click",
 *      "url": "#"
 *  }
 * }```]
 */
export function dbg<T extends unknown[]>(...args: T): T {
  if (import.meta.env.SSR) console.log("\n");
  console.dir(args, {
    depth: 8,
    colors: true,
    numericSeparator: true,
    showHidden: false,
  });
  if (import.meta.env.SSR) console.log("\n");

  return args;
}
