/**
 * An useful collection of date formatting strings that we use across the UI,
 * meant for use with `dayjs` (or any other) date utility.
 *
 * @example
 * dayjs().format(dateFormat.monthDate)
 * "Jun. 14"
 */
const dateFormat = {
  /** 1. May 2023 */
  dateMonthWordFullYear: "D. MMMM YYYY",
  /** Jun. 14 */
  monthDate: "MMM. DD",
  /** 1991-05-22 */
  yearMonthDateDash: "YYYY-MM-DD",
} as const;

export default dateFormat;
