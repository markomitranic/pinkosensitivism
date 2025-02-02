import { NextResponse } from "next/server";

/**
 * Creates a response object with a redirect directive.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/Response/redirect_static
 *
 * @example
 * return respondWithRedirect("https://example.com/test");
 * return respondWithRedirect("https://example.com/", 301);
 * return Api.respondWithRedirect(new URL(redirectTo, request.url));
 */
export default function respondWithRedirect(
  target: string | URL,
  status: 301 | 302 | 303 | 307 | 308 = 302,
) {
  return NextResponse.redirect(target, { status });
}
