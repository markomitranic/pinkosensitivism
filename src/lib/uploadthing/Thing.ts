import { readFile } from "fs/promises";
import "server-cli-only";
import { UTApi, UTFile } from "uploadthing/server";

const utapi = new UTApi();

export const Thing = {
  client: utapi,

  uploadFromDisk: async (filePath: string, fileName: string) => {
    const data = await readFile(filePath);
    const [result] = await utapi.uploadFiles([new UTFile([data], fileName)]);
    if (!result) throw Error(`File upload failed: ${JSON.stringify(result)}`);
    return result;
  },
};
