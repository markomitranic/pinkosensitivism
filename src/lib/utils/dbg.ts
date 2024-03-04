// eslint-disable-next-line @typescript-eslint/no-unused-vars
import { type inspect } from "util";

/**
 * Pretty-prints the given arguments into the console, by deeply unwrapping
 * stringified objects with indentation.
 *
 * @deprecated **Should only be used for development.**
 *
 * @see {@link inspect} Similar,more powerful, built-in alternative,
 * that is a bit harder to use in daily life.
 *
 * @example
 * dbg("test")
 * "test"
 *
 * dbg("test", 123)
 * "test"
 * 123
 *
 * dbg({ id: 1, cta: { label: "Click", url: "#"} })
 * {
 *  "id": 1,
 *  "cta": {
 *      "label": "Click",
 *      "url": "#"
 *  }
 * }
 */
export function dbg(...args: unknown[]): void {
  console.debug(...args.map((arg) => JSON.stringify(arg, null, 2)));
}
