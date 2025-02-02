import JsonView from "@uiw/react-json-view";
import { darkTheme } from "@uiw/react-json-view/dark";
import { cn } from "~/utils/cn";

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
export default function Dbg<T extends object>({
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
  return (
    <div ref={ref} className={cn("p-3", className)}>
      {title && <p>{title} DEBUG:</p>}
      <JsonView
        value={children ?? {}}
        style={darkTheme}
        className="border border-dashed border-red-600 p-6"
      />
    </div>
  );
}
