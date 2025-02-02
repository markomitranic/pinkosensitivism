import { twMerge, type ClassNameValue } from "tailwind-merge";

/**
 * Allows conditional class application, sorting suggestions and intellisense.
 *
 * Inspired by `shadcn/ui`, `twMerge` Simply ensures that class precedence
 * behaves as expected in Tailwind-based projects - later classes can override earlier.
 *
 * @see https://github.com/dcastil/tailwind-merge
 *
 * @example
 * cn('mb-10 text-sm')
 *
 * cn(
 *  "mb-10 text-sm",
 *  props.active && "text-primary pt-1 md:mb-0",
 *  props.className,
 * );
 *
 */
export function cn(...args: ClassNameValue[]) {
  return twMerge(...args);
}
