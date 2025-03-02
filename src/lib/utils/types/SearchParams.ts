type SearchParamValue = string | string[] | undefined;
type GenericSearchParams = Record<string, SearchParamValue>;

/**
 * Represents the GET search parameters of a URL.
 *
 * **All required generics parameters will be cast as optional.**
 *
 * Allows for extending the search parameters with more specifc named keys,
 * while retaining the generic `Record<string, SearchParamValue>` type.
 *
 * @example
 * type QueryParams = SearchParams<{ page?: string }>;
 * type QueryParams = SearchParams;
 */
export type SearchParams<T extends GenericSearchParams = GenericSearchParams> =
  Promise<GenericSearchParams & Partial<T>>;
