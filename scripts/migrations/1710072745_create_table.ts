import { sql, type Kysely } from "kysely";

export async function up(db: Kysely<unknown>): Promise<void> {
  await db.schema
    .createTable("posts")
    .addColumn("id", "serial", (col) => col.primaryKey())
    .addColumn("instagram_uuid", "varchar(50)", (col) => col.notNull())
    .addColumn("url", "varchar", (col) => col.notNull())
    .addColumn("instagram_date", "timestamp", (col) => col.notNull())
    .addColumn("modified_at", "timestamp", (col) =>
      col.defaultTo(sql`now()`).notNull(),
    )
    .execute();
}

export async function down(db: Kysely<unknown>): Promise<void> {
  await db.schema.dropTable("posts").execute();
}
