import JsonView from "@uiw/react-json-view";
import { darkTheme } from "@uiw/react-json-view/dark";
import { isObject } from "lodash-es";
import { cn } from "~/lib/utils/cn";

export type DbgChildren =
  | object
  | Array<unknown>
  | string
  | number
  | boolean
  | null
  | undefined;

/**
 * Dumps a variable as a component on the page.
 * Equivalent of `dump` in Symfony or `dbg` in Livebooks..
 *
 * @deprecated **Should only be used for development.**
 *
 * @example
 * <Dbg>{{ foo: "bar" }}</Dbg>
 *
 * <Dbg title="Category Params dump">{{ params, categoryId }}</Dbg>
 */
export function Dbg<T extends DbgChildren>({
  title,
  children,
  className,
  ref,
}: {
  title?: string;
  children?: T;
  className?: string;
  ref?: React.Ref<HTMLDivElement>;
}) {
  console.log(children);
  return (
    <div ref={ref} className={cn("p-3", className)}>
      {title && <p>{title} DEBUG:</p>}
      <JsonView
        value={isObject(children) ? children : { RAW_VALUE: children }}
        style={darkTheme}
        className="border border-dashed border-red-600 p-6"
      />
    </div>
  );
}
