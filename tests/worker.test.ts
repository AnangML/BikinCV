import { afterEach, describe, expect, it, vi } from "vitest";
import worker from "../worker/index";

function createMockEnv(overrides: Partial<Env> = {}): Env {
  return {
    GEMINI_API_KEY: "test-gemini-key",
    GEMINI_MODEL: "gemini-3-flash-preview",
    GEMINI_ENDPOINT: "https://generativelanguage.googleapis.com/v1beta/models",
    ASSETS: {
      fetch: vi.fn(async () => new Response("asset-ok", { status: 200 })),
    } as unknown as Fetcher,
    ...overrides,
  };
}

afterEach(() => {
  vi.restoreAllMocks();
});

describe("BikinCV Cloudflare Worker", () => {
  it("returns 200 ok on GET /up", async () => {
    const env = createMockEnv();
    const res = await worker.fetch(new Request("https://bikincv.test/up"), env);

    expect(res.status).toBe(200);
    await expect(res.json()).resolves.toEqual({ status: "ok" });
  });

  it("redirects legacy Laravel routes to /", async () => {
    const env = createMockEnv();
    for (const path of ["/login", "/register", "/dashboard", "/cv/save"]) {
      const res = await worker.fetch(new Request(`https://bikincv.test${path}`), env);
      expect(res.status).toBe(302);
      expect(res.headers.get("Location")).toBe("https://bikincv.test/");
    }
  });

  it("returns 422 on empty payload even if GEMINI_API_KEY is missing", async () => {
    const env = createMockEnv({ GEMINI_API_KEY: "" });
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({}),
      }),
      env,
    );

    expect(res.status).toBe(422);
  });

  it("returns 422 when text exceeds 5000 characters", async () => {
    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ text: "a".repeat(5001) }),
      }),
      env,
    );

    expect(res.status).toBe(422);
  });

  it("returns 503 with fallback flag when GEMINI_API_KEY is not configured", async () => {
    const env = createMockEnv({ GEMINI_API_KEY: "" });
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ text: "Memimpin tim" }),
      }),
      env,
    );

    expect(res.status).toBe(503);
    await expect(res.json()).resolves.toMatchObject({
      success: false,
      fallback: true,
    });
  });

  it("blocks cross-origin requests with 403", async () => {
    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "Sec-Fetch-Site": "cross-site",
        },
        body: JSON.stringify({ text: "Memimpin tim" }),
      }),
      env,
    );

    expect(res.status).toBe(403);
  });

  it("translates single text via Gemini and sends API key via header", async () => {
    const fetchSpy = vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          candidates: [
            {
              content: {
                parts: [{ text: "Spearheaded 6 software engineers in payment systems" }],
              },
            },
          ],
        }),
        { status: 200, headers: { "Content-Type": "application/json" } },
      ),
    );

    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          text: "Memimpin 6 insinyur perangkat lunak sistem pembayaran",
        }),
      }),
      env,
    );

    expect(res.status).toBe(200);
    await expect(res.json()).resolves.toEqual({
      success: true,
      translated: "Spearheaded 6 software engineers in payment systems",
      provider: "gemini",
    });

    const [calledUrl, calledInit] = fetchSpy.mock.calls[0] as [string, RequestInit];
    expect(calledUrl).not.toContain("key=");
    expect((calledInit.headers as Record<string, string>)["x-goog-api-key"]).toBe("test-gemini-key");
  });

  it("translates batch CV including Indonesian dates and languages", async () => {
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          candidates: [
            {
              content: {
                parts: [
                  {
                    text: JSON.stringify({
                      job_title: "Software Engineer",
                      exp_0_start: "Agu 2023",
                      exp_0_end: "Okt 2023",
                      cert_0_expiry: "Seumur Hidup",
                      lang_0_name: "Indonesian",
                      lang_0_level: "Native or Bilingual Proficiency",
                    }),
                  },
                ],
              },
            },
          ],
        }),
        { status: 200, headers: { "Content-Type": "application/json" } },
      ),
    );

    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({
          cv: {
            personal: { jobTitle: "Rekayasa Perangkat Lunak" },
            experiences: [{ position: "Developer", startDate: "Agu 2023", endDate: "Okt 2023" }],
            certifications: [{ name: "Laravel Certified", expiryDate: "Seumur Hidup" }],
            languages: [{ name: "Bahasa Indonesia", level: "Penutur Asli" }],
          },
        }),
      }),
      env,
    );

    expect(res.status).toBe(200);
    await expect(res.json()).resolves.toMatchObject({
      success: true,
      provider: "gemini",
      cv: {
        personal: { jobTitle: "Software Engineer" },
        experiences: [{ startDate: "Aug 2023", endDate: "Oct 2023" }],
        certifications: [{ expiryDate: "Lifetime" }],
        languages: [{ name: "Indonesian", level: "Native or Bilingual Proficiency" }],
      },
    });
  });

  it("does not leak raw Gemini error body when upstream fails", async () => {
    vi.spyOn(console, "error").mockImplementation(() => {});
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response("SECRET_UPSTREAM_DEBUG_INFO", { status: 500 }),
    );

    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ text: "Halo" }),
      }),
      env,
    );

    expect(res.status).toBe(500);
    const body = (await res.json()) as Record<string, unknown>;
    expect(body).toEqual({
      success: false,
      message: "Failed to translate single text with Gemini.",
      fallback: true,
    });
    expect(JSON.stringify(body)).not.toContain("SECRET_UPSTREAM_DEBUG_INFO");
  });

  it("returns 500 with fallback flag when Gemini returns invalid JSON", async () => {
    vi.spyOn(console, "error").mockImplementation(() => {});
    vi.spyOn(globalThis, "fetch").mockResolvedValue(
      new Response(
        JSON.stringify({
          candidates: [{ content: { parts: [{ text: "not valid json" }] } }],
        }),
        { status: 200, headers: { "Content-Type": "application/json" } },
      ),
    );

    const env = createMockEnv();
    const res = await worker.fetch(
      new Request("https://bikincv.test/cv/translate-ai", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ cv: { personal: { jobTitle: "Insinyur" } } }),
      }),
      env,
    );

    expect(res.status).toBe(500);
    await expect(res.json()).resolves.toMatchObject({
      success: false,
      fallback: true,
    });
  });
});
