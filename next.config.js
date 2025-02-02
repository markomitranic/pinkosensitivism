/**
 * Basic NextJS Configuration
 * @type {import("next").NextConfig}
 */
const config = {
  eslint: { ignoreDuringBuilds: true },
  images: {
    minimumCacheTTL: 31536000,
  },
  async headers() {
    return [
      {
        source: "/:path*",
        headers: [
          // Set cache headers, on all pages.
          {
            key: "Cache-Control",
            value: "public, s-maxage=300, stale-while-revalidate=300",
          },
        ],
      },
    ];
  },
};

export default config;
