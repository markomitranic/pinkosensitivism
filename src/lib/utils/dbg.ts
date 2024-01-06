export function dbg(data: unknown) {
  console.debug(JSON.stringify(data, null, 2));
}
