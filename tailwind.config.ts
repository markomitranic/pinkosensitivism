import { type Config } from "tailwindcss";
import defaultTheme from "tailwindcss/defaultTheme";

export default {
  content: ["./src/**/*.tsx"],
  theme: {
    extend: {
      colors: {
        ...defaultTheme.colors,
        // Vanilla Ice
        pinko: {
          DEFAULT: "#f5ddde",
          "50": "#fbf5f5",
          "100": "#f8e8e9",
          "200": "#f5ddde",
          "300": "#e9b8ba",
          "400": "#db8e91",
          "500": "#ca696d",
          "600": "#b54d51",
          "700": "#973e42",
          "800": "#7e3639",
          "900": "#6a3234",
          "950": "#381718",
        },
      },
    },
  },
} satisfies Config;
