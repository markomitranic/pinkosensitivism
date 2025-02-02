"use client";

import { cn } from "~/utils/cn";
import { type ChildrenType } from "~/utils/types/ChildrenType";

/**
 * Prints out a text snippet with preformatted styling.
 *
 * @example
 * <Code>4571 0000 0000 0001</Code>
 *
 * <Code title="Dankort">4571 0000 0000 0001</Code>
 */
export function Code({
  children,
  className,
  title,
}: {
  children: ChildrenType;
  className?: string;
  title?: string;
}) {
  // eslint-disable-next-line @typescript-eslint/no-base-to-string
  const value = children?.toString() ?? "";
  const copyToClipboard = () => {
    navigator.clipboard
      .writeText(value)
      .then(() => {
        console.log({
          title: "Copied to clipboard",
          description: value,
        });
      })
      .catch((err) => {
        console.error("Failed to copy text: ", err);
      });
  };

  return (
    <code
      className={cn(
        "border-feedback-error-red bg-feedback-error-red/15 text-feedback-error-red cursor-pointer rounded border px-0.5 py-0 font-mono text-xs leading-3",
        className,
      )}
      onClick={copyToClipboard}
    >
      {title && <p>{title} DEBUG:</p>}
      {children}
    </code>
  );
}
