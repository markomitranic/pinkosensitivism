import {
  ListObjectsV2Command,
  PutObjectCommand,
  S3Client,
} from "@aws-sdk/client-s3";
import fs from "fs";
import path from "path";
import { env } from "~/lib/env";
import { getMimeType } from "./utils/getMimeType";

const s3Client = new S3Client({
  endpoint: env.server.S3_ENDPOINT,
  region: "auto",
  credentials: {
    accessKeyId: env.server.S3_ACCESS_KEY_ID,
    secretAccessKey: env.server.S3_SECRET_ACCESS_KEY,
  },
});

export const BlobStorage = {
  getClient() {
    return s3Client;
  },

  async listAllFiles() {
    const command = new ListObjectsV2Command({
      Bucket: env.server.S3_BUCKET_NAME,
    });
    const response = await s3Client.send(command);
    return response.Contents ?? [];
  },

  /**
   * Reads the file from the disk, and uploads it to the S3 bucket. Does not
   * work with remote files.
   *
   * It will automatically deduce the mime type unless explicitly provided.
   * If no key is provided, it will use the filename from the pathname.
   *
   * @see BlobStorage.uploadFileFromUrl
   *
   * @example
   * await BlobStorage.uploadFile("public/favicon.svg"); // Will use "favicon.svg" as key
   * await BlobStorage.uploadFile("public/favicon.svg", "custom-name.svg");
   */
  async uploadFile(pathname: string, key?: string, contentType?: string) {
    const filePath = path.join(process.cwd(), pathname);
    const fileContent = await fs.promises.readFile(filePath);
    const derivedKey = key || path.basename(pathname);

    const command = new PutObjectCommand({
      Bucket: env.server.S3_BUCKET_NAME,
      Key: derivedKey,
      Body: fileContent,
      ContentType: contentType || getMimeType(derivedKey),
    });

    await s3Client.send(command);
  },

  /**
   * Uploads a file from a URL to the S3 bucket. Similar to `uploadFile`, but
   * works only with remote files.
   *
   * @see BlobStorage.uploadFile
   *
   * @example
   * await BlobStorage.uploadFileFromUrl("https://example.com/favicon.svg", "favicon.svg");
   */
  async uploadFileFromUrl(url: string, key: string, contentType?: string) {
    const response = await fetch(url);
    const fileContent = await response.arrayBuffer();

    const command = new PutObjectCommand({
      Bucket: env.server.S3_BUCKET_NAME,
      Key: key,
      Body: new Uint8Array(fileContent),
      ContentType: contentType || getMimeType(url),
    });

    await s3Client.send(command);
  },

  /**
   * Generates a public URL for an R2 object using our custom domain.
   *
   * @example
   * ```ts
   * getPublicStorageUrl("favicon.svg");
   * "https://storage.pinkosensitivism.com/favicon.svg"
   * ```
   */
  getPublicStorageUrl(key: string | null | undefined): string | null {
    if (!key?.length) {
      throw new Error("Object Key is required to generate a public URL");
    }
    return `${env.client.S3_PUBLIC_URL}/${key}`;
  },
};
