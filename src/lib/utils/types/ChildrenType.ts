/**
 * Commonly used child node type.
 *
 * This is an internal alias to `React.ReactNode`, because we keep
 * forgetting which one is which.
 *
 * - `JSX.Element` represents only JSX.
 * - ReactNode is a superset of `JSX.Element`
 * - Apart from the obvious `JSX.Element` it also supports anything
 * that react can handle as children.
 *
 * @example
 * const examples: Child[] = [
 *  <div />,
 *  [<div />, <div />],
 *  "Hello!",
 *  123,
 *  false,
 *  undefined,
 *  null
 * ]
 */
export type ChildrenType = React.ReactNode;
