import { handleTranslateAi } from "./translate";

const LEGACY_REDIRECT_PATHS = new Set(["/login", "/register", "/dashboard", "/cv/save"]);

export default {
  async fetch(request: Request, env: Env): Promise<Response> {
    const url = new URL(request.url);

    if (url.pathname === "/up" && request.method === "GET") {
      return new Response(JSON.stringify({ status: "ok" }), {
        status: 200,
        headers: {
          "Content-Type": "application/json; charset=utf-8",
        },
      });
    }

    if (LEGACY_REDIRECT_PATHS.has(url.pathname) && (request.method === "GET" || request.method === "HEAD")) {
      return Response.redirect(new URL("/", url.origin).toString(), 302);
    }

    if (url.pathname === "/cv/translate-ai") {
      if (request.method !== "POST") {
        return new Response(
          JSON.stringify({
            success: false,
            message: "Method Not Allowed",
          }),
          {
            status: 405,
            headers: {
              "Content-Type": "application/json; charset=utf-8",
              Allow: "POST",
            },
          },
        );
      }

      return handleTranslateAi(request, env);
    }

    return env.ASSETS.fetch(request);
  },
} satisfies ExportedHandler<Env>;
