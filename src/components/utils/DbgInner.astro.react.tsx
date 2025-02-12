import type { ReactElement } from "react";
import { Dbg as ReactDbg } from "./Dbg.react";

export function DbgInner({
  children,
  ...rest
}: {
  children: string;
  title?: string;
  className?: string;
}) {
  /**
   * We type it as string in order to enforce correct outside usage.
   * Astro will automagically wrap it into a ReactElement.
   */
  const itsActuallyAnElement = children as unknown as ReactElement;
  const value = JSON.parse(
    (itsActuallyAnElement?.props as { value?: string })?.value ??
      `{"PARSE_ERROR": "Dbg component received non-string value"}`,
  ) as object;

  return <ReactDbg {...rest}>{value}</ReactDbg>;
}
