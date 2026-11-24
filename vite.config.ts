import fs from "node:fs";
import path from "node:path";
import { defineConfig, type Plugin } from "vite";
import { cloudflare } from "@cloudflare/vite-plugin";
import tailwindcss from "@tailwindcss/vite";

/**
 * Mengganti placeholder `<!-- @include path/to/file.html -->` pada index.html
 * dan memantau perubahan file template untuk HMR saat `vite dev`.
 */
function htmlIncludePlugin(): Plugin {
  const includePattern = /<!--\s*@include\s+([^\s]+)\s*-->/g;
  const templatesDir = path.resolve(process.cwd(), "src/templates");

  return {
    name: "bikincv-html-include",
    transformIndexHtml(html) {
      return html.replace(includePattern, (_match, relPath: string) => {
        const fullPath = path.resolve(process.cwd(), relPath);
        return fs.readFileSync(fullPath, "utf8");
      });
    },
    configureServer(server) {
      server.watcher.add(templatesDir);
      server.watcher.on("change", (changedPath) => {
        if (changedPath.startsWith(templatesDir)) {
          server.ws.send({ type: "full-reload" });
        }
      });
    },
  };
}

export default defineConfig({
  plugins: [htmlIncludePlugin(), tailwindcss(), cloudflare()],
});
