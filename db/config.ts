import { column, defineDb, defineTable } from "astro:db";

const Posts = defineTable({
  columns: {
    id: column.number({ primaryKey: true, autoIncrement: true }),
    instagram_uuid: column.text(),
    filepath: column.text(),
    posted_at: column.text(),
  },
});

// https://astro.build/db/config
export default defineDb({
  tables: { Posts },
});
