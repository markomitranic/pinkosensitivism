import path from "path";

const IMAGE_MIME_TYPES: Record<string, string> = {
  ".png": "image/png",
  ".jpg": "image/jpeg",
  ".jpeg": "image/jpeg",
  ".gif": "image/gif",
  ".svg": "image/svg+xml",
  ".webp": "image/webp",
};

type MimeType = (typeof IMAGE_MIME_TYPES)[string];

/**
 * Detects MIME type from file extension for common image formats.
 * Falls back to application/octet-stream if the extension is not recognized.
 */
export function getMimeType(filepath: string): MimeType {
  const ext = path.extname(filepath).toLowerCase();
  return IMAGE_MIME_TYPES[ext] || "application/octet-stream";
}
