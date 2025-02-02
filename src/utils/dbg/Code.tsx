"use client";

import { cn } from "~/lib/utils/tailwind/cn";
import { type ChildrenType } from "~/lib/utils/types/ChildrenType";
import {
  Tooltip,
  TooltipContent,
  TooltipProvider,
  TooltipTrigger,
} from "./primitives/tooltip";
import { useToast } from "./primitives/use-toast";

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
  const { toast } = useToast();
  // eslint-disable-next-line @typescript-eslint/no-base-to-string
  const value = children?.toString() ?? "";
  const copyToClipboard = () => {
    navigator.clipboard
      .writeText(value)
      .then(() => {
        toast({
          title: "Copied to clipboard",
          description: value,
          duration: 1000,
        });
      })
      .catch((err) => {
        console.error("Failed to copy text: ", err);
      });
  };

  return (
    <TooltipProvider>
      <Tooltip>
        <TooltipTrigger type="button">
          <code
            className={cn(
              "cursor-pointer rounded border border-feedback-error-red bg-feedback-error-red/15 px-0.5 py-0 font-mono text-xs leading-3 text-feedback-error-red",
              className,
            )}
            onClick={copyToClipboard}
          >
            {title && <p>{title} DEBUG:</p>}
            {children}
          </code>
        </TooltipTrigger>
        <TooltipContent>Click to copy</TooltipContent>
      </Tooltip>
    </TooltipProvider>
  );
}
