import { column, defineDb, defineTable } from "astro:db";

export const Posts = defineTable({
  columns: {
    id: column.number({ primaryKey: true, autoIncrement: true }),
    instagram_uuid: column.text(),
    filepath: column.text(),
    blurhash: column.text({ optional: true }),
    posted_at: column.text(),
  },
});

// https://astro.build/db/config
export default defineDb({
  tables: { Posts },
});
