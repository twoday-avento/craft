import { defineConfig } from "vite";
import tailwindcss from "@tailwindcss/vite";
import manifestSRI from "vite-plugin-manifest-sri";
import ViteRestart from "vite-plugin-restart";
import path from "path";

// https://vitejs.dev/config/
export default defineConfig(({ command }) => ({
  base: command === "serve" ? "" : "/dist/",
  build: {
    manifest: true,
    outDir: path.resolve(__dirname, "web/dist/"),
    rollupOptions: {
      input: {
        app: path.resolve(__dirname, "src/js/app.js"),
      },
      output: {
        sourcemap: true,
      },
    },
  },
  plugins: [
    tailwindcss(),
    manifestSRI(),
    ViteRestart({
      reload: ["templates/**/*"],
    }),
  ],
  publicDir: path.resolve(__dirname, "src/public"),
  resolve: {
    alias: {
      "@": path.resolve(__dirname, "src"),
      "@css": path.resolve(__dirname, "src/css"),
      "@js": path.resolve(__dirname, "src/js"),
    },
  },
  server: {
    host: "0.0.0.0",
    port: 3000,
    strictPort: true,
  },
}));
