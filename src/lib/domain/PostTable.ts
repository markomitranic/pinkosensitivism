import { type ColumnType, type Generated } from "kysely";

export interface PostTable {
  id: Generated<number>;
  instagram_uuid: string;
  url: string;
  instagram_date: Date;
  modified_at: ColumnType<Date, string | undefined, never>;
}
