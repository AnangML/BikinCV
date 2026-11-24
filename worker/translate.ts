import {
  type CvPayload,
  sanitizeAllDatesInCv,
  translateIndonesianDate,
} from "./date-utils";

const MAX_SINGLE_TEXT_LENGTH = 5_000;
const MAX_BATCH_FIELDS = 250;
const MAX_BATCH_TOTAL_CHARS = 30_000;
const DEFAULT_GEMINI_MODEL = "gemini-3-flash-preview";
const DEFAULT_GEMINI_ENDPOINT = "https://generativelanguage.googleapis.com/v1beta/models";

interface GeminiResponse {
  candidates?: Array<{
    content?: {
      parts?: Array<{
        text?: string;
      }>;
    };
  }>;
}

interface TranslateRequestBody {
  cv?: unknown;
  text?: unknown;
}

function jsonResponse(body: Record<string, unknown>, status = 200): Response {
  return new Response(JSON.stringify(body), {
    status,
    headers: {
      "Content-Type": "application/json; charset=utf-8",
    },
  });
}

function isPlainObject(value: unknown): value is Record<string, unknown> {
  return typeof value === "object" && value !== null && !Array.isArray(value);
}

function isAllowedSameOrigin(request: Request): boolean {
  const secFetchSite = request.headers.get("Sec-Fetch-Site");
  if (secFetchSite && secFetchSite !== "same-origin" && secFetchSite !== "none") {
    return false;
  }

  const origin = request.headers.get("Origin");
  if (origin) {
    const requestOrigin = new URL(request.url).origin;
    if (origin !== requestOrigin) {
      return false;
    }
  }

  return true;
}

function cleanAndDecodeJson(content: string): Record<string, string> {
  let cleanJson = content.trim();

  if (cleanJson.startsWith("```json")) {
    cleanJson = cleanJson.slice(7).trim();
  } else if (cleanJson.startsWith("```")) {
    cleanJson = cleanJson.slice(3).trim();
  }

  if (cleanJson.endsWith("```")) {
    cleanJson = cleanJson.slice(0, -3).trim();
  }

  const parsed: unknown = JSON.parse(cleanJson);
  if (!isPlainObject(parsed)) {
    throw new Error("Gemini returned non-object JSON.");
  }

  const result: Record<string, string> = {};
  for (const [key, val] of Object.entries(parsed)) {
    if (typeof val === "string") {
      result[key] = val;
    }
  }
  return result;
}

function extractTranslatableMap(cv: CvPayload): Record<string, string> {
  const map: Record<string, string> = {};

  if (isPlainObject(cv.personal)) {
    if (typeof cv.personal.jobTitle === "string" && cv.personal.jobTitle) {
      map.job_title = cv.personal.jobTitle;
    }
    if (typeof cv.personal.summary === "string" && cv.personal.summary) {
      map.summary = cv.personal.summary;
    }
    if (typeof cv.personal.location === "string" && cv.personal.location) {
      map.location = cv.personal.location;
    }
  }

  if (Array.isArray(cv.experiences)) {
    cv.experiences.forEach((exp, idx) => {
      if (!isPlainObject(exp)) return;
      if (typeof exp.position === "string" && exp.position) {
        map[`exp_${idx}_position`] = exp.position;
      }
      if (typeof exp.location === "string" && exp.location) {
        map[`exp_${idx}_location`] = exp.location;
      }
      if (typeof exp.startDate === "string" && exp.startDate) {
        map[`exp_${idx}_start`] = exp.startDate;
      }
      if (typeof exp.endDate === "string" && exp.endDate) {
        map[`exp_${idx}_end`] = exp.endDate;
      }
      if (Array.isArray(exp.bullets)) {
        exp.bullets.forEach((bullet, bIdx) => {
          if (typeof bullet === "string" && bullet.trim() !== "") {
            map[`exp_${idx}_bullet_${bIdx}`] = bullet;
          }
        });
      }
    });
  }

  if (Array.isArray(cv.educations)) {
    cv.educations.forEach((edu, idx) => {
      if (!isPlainObject(edu)) return;
      if (typeof edu.degree === "string" && edu.degree) {
        map[`edu_${idx}_degree`] = edu.degree;
      }
      if (typeof edu.location === "string" && edu.location) {
        map[`edu_${idx}_location`] = edu.location;
      }
      if (typeof edu.startDate === "string" && edu.startDate) {
        map[`edu_${idx}_start`] = edu.startDate;
      }
      if (typeof edu.endDate === "string" && edu.endDate) {
        map[`edu_${idx}_end`] = edu.endDate;
      }
    });
  }

  if (Array.isArray(cv.certifications)) {
    cv.certifications.forEach((cert, idx) => {
      if (!isPlainObject(cert)) return;
      if (typeof cert.name === "string" && cert.name) {
        map[`cert_${idx}_name`] = cert.name;
      }
      if (typeof cert.issuer === "string" && cert.issuer) {
        map[`cert_${idx}_issuer`] = cert.issuer;
      }
      if (typeof cert.issueDate === "string" && cert.issueDate) {
        map[`cert_${idx}_issue`] = cert.issueDate;
      }
      if (typeof cert.expiryDate === "string" && cert.expiryDate) {
        map[`cert_${idx}_expiry`] = cert.expiryDate;
      }
    });
  }

  if (Array.isArray(cv.projects)) {
    cv.projects.forEach((proj, idx) => {
      if (!isPlainObject(proj)) return;
      if (typeof proj.role === "string" && proj.role) {
        map[`proj_${idx}_role`] = proj.role;
      }
      if (typeof proj.description === "string" && proj.description) {
        map[`proj_${idx}_desc`] = proj.description;
      }
    });
  }

  if (Array.isArray(cv.trainings)) {
    cv.trainings.forEach((train, idx) => {
      if (!isPlainObject(train)) return;
      if (typeof train.title === "string" && train.title) {
        map[`train_${idx}_title`] = train.title;
      }
      if (typeof train.field === "string" && train.field) {
        map[`train_${idx}_field`] = train.field;
      }
      if (typeof train.subField === "string" && train.subField) {
        map[`train_${idx}_subfield`] = train.subField;
      }
      if (typeof train.location === "string" && train.location) {
        map[`train_${idx}_location`] = train.location;
      }
      if (typeof train.startDate === "string" && train.startDate) {
        map[`train_${idx}_start`] = train.startDate;
      }
      if (typeof train.endDate === "string" && train.endDate) {
        map[`train_${idx}_end`] = train.endDate;
      }
      if (typeof train.description === "string" && train.description) {
        map[`train_${idx}_desc`] = train.description;
      }
    });
  }

  if (Array.isArray(cv.languages)) {
    cv.languages.forEach((lang, idx) => {
      if (!isPlainObject(lang)) return;
      if (typeof lang.name === "string" && lang.name) {
        map[`lang_${idx}_name`] = lang.name;
      }
      if (typeof lang.level === "string" && lang.level) {
        map[`lang_${idx}_level`] = lang.level;
      }
      if (typeof lang.info === "string" && lang.info) {
        map[`lang_${idx}_info`] = lang.info;
      }
    });
  }

  return map;
}

function applyTranslatedMap(cv: CvPayload, translatedMap: Record<string, string>): CvPayload {
  const clone = structuredClone(cv);

  if (isPlainObject(clone.personal)) {
    if (translatedMap.job_title !== undefined) {
      clone.personal.jobTitle = translatedMap.job_title;
    }
    if (translatedMap.summary !== undefined) {
      clone.personal.summary = translatedMap.summary;
    }
    if (translatedMap.location !== undefined) {
      clone.personal.location = translatedMap.location;
    }
  }

  if (Array.isArray(clone.experiences)) {
    clone.experiences.forEach((exp, idx) => {
      if (!isPlainObject(exp)) return;
      if (translatedMap[`exp_${idx}_position`] !== undefined) {
        exp.position = translatedMap[`exp_${idx}_position`];
      }
      if (translatedMap[`exp_${idx}_location`] !== undefined) {
        exp.location = translatedMap[`exp_${idx}_location`];
      }
      if (translatedMap[`exp_${idx}_start`] !== undefined) {
        exp.startDate = translateIndonesianDate(translatedMap[`exp_${idx}_start`]);
      } else if (typeof exp.startDate === "string" && exp.startDate) {
        exp.startDate = translateIndonesianDate(exp.startDate);
      }
      if (translatedMap[`exp_${idx}_end`] !== undefined) {
        exp.endDate = translateIndonesianDate(translatedMap[`exp_${idx}_end`]);
      } else if (typeof exp.endDate === "string" && exp.endDate) {
        exp.endDate = translateIndonesianDate(exp.endDate);
      }
      if (Array.isArray(exp.bullets)) {
        exp.bullets = exp.bullets.map((bullet, bIdx) => {
          const translated = translatedMap[`exp_${idx}_bullet_${bIdx}`];
          return translated !== undefined ? translated : bullet;
        });
      }
    });
  }

  if (Array.isArray(clone.educations)) {
    clone.educations.forEach((edu, idx) => {
      if (!isPlainObject(edu)) return;
      if (translatedMap[`edu_${idx}_degree`] !== undefined) {
        edu.degree = translatedMap[`edu_${idx}_degree`];
      }
      if (translatedMap[`edu_${idx}_location`] !== undefined) {
        edu.location = translatedMap[`edu_${idx}_location`];
      }
      if (translatedMap[`edu_${idx}_start`] !== undefined) {
        edu.startDate = translateIndonesianDate(translatedMap[`edu_${idx}_start`]);
      } else if (typeof edu.startDate === "string" && edu.startDate) {
        edu.startDate = translateIndonesianDate(edu.startDate);
      }
      if (translatedMap[`edu_${idx}_end`] !== undefined) {
        edu.endDate = translateIndonesianDate(translatedMap[`edu_${idx}_end`]);
      } else if (typeof edu.endDate === "string" && edu.endDate) {
        edu.endDate = translateIndonesianDate(edu.endDate);
      }
    });
  }

  if (Array.isArray(clone.certifications)) {
    clone.certifications.forEach((cert, idx) => {
      if (!isPlainObject(cert)) return;
      if (translatedMap[`cert_${idx}_name`] !== undefined) {
        cert.name = translatedMap[`cert_${idx}_name`];
      }
      if (translatedMap[`cert_${idx}_issuer`] !== undefined) {
        cert.issuer = translatedMap[`cert_${idx}_issuer`];
      }
      if (translatedMap[`cert_${idx}_issue`] !== undefined) {
        cert.issueDate = translateIndonesianDate(translatedMap[`cert_${idx}_issue`]);
      } else if (typeof cert.issueDate === "string" && cert.issueDate) {
        cert.issueDate = translateIndonesianDate(cert.issueDate);
      }
      if (translatedMap[`cert_${idx}_expiry`] !== undefined) {
        cert.expiryDate = translateIndonesianDate(translatedMap[`cert_${idx}_expiry`]);
      } else if (typeof cert.expiryDate === "string" && cert.expiryDate) {
        cert.expiryDate = translateIndonesianDate(cert.expiryDate);
      }
    });
  }

  if (Array.isArray(clone.projects)) {
    clone.projects.forEach((proj, idx) => {
      if (!isPlainObject(proj)) return;
      if (translatedMap[`proj_${idx}_role`] !== undefined) {
        proj.role = translatedMap[`proj_${idx}_role`];
      }
      if (translatedMap[`proj_${idx}_desc`] !== undefined) {
        proj.description = translatedMap[`proj_${idx}_desc`];
      }
    });
  }

  if (Array.isArray(clone.trainings)) {
    clone.trainings.forEach((train, idx) => {
      if (!isPlainObject(train)) return;
      if (translatedMap[`train_${idx}_title`] !== undefined) {
        train.title = translatedMap[`train_${idx}_title`];
      }
      if (translatedMap[`train_${idx}_field`] !== undefined) {
        train.field = translatedMap[`train_${idx}_field`];
      }
      if (translatedMap[`train_${idx}_subfield`] !== undefined) {
        train.subField = translatedMap[`train_${idx}_subfield`];
      }
      if (translatedMap[`train_${idx}_location`] !== undefined) {
        train.location = translatedMap[`train_${idx}_location`];
      }
      if (translatedMap[`train_${idx}_start`] !== undefined) {
        train.startDate = translateIndonesianDate(translatedMap[`train_${idx}_start`]);
      } else if (typeof train.startDate === "string" && train.startDate) {
        train.startDate = translateIndonesianDate(train.startDate);
      }
      if (translatedMap[`train_${idx}_end`] !== undefined) {
        train.endDate = translateIndonesianDate(translatedMap[`train_${idx}_end`]);
      } else if (typeof train.endDate === "string" && train.endDate) {
        train.endDate = translateIndonesianDate(train.endDate);
      }
      if (translatedMap[`train_${idx}_desc`] !== undefined) {
        train.description = translatedMap[`train_${idx}_desc`];
      }
    });
  }

  if (Array.isArray(clone.languages)) {
    clone.languages.forEach((lang, idx) => {
      if (!isPlainObject(lang)) return;
      if (translatedMap[`lang_${idx}_name`] !== undefined) {
        lang.name = translatedMap[`lang_${idx}_name`];
      }
      if (translatedMap[`lang_${idx}_level`] !== undefined) {
        lang.level = translatedMap[`lang_${idx}_level`];
      }
      if (translatedMap[`lang_${idx}_info`] !== undefined) {
        lang.info = translatedMap[`lang_${idx}_info`];
      }
    });
  }

  return clone;
}

async function callGemini(
  env: Env,
  prompt: string,
  maxOutputTokens: number,
  timeoutMs: number,
): Promise<string> {
  const apiKey = (env.GEMINI_API_KEY ?? "").trim();
  const model = (env.GEMINI_MODEL || DEFAULT_GEMINI_MODEL).trim();
  const endpoint = (env.GEMINI_ENDPOINT || DEFAULT_GEMINI_ENDPOINT).replace(/\/+$/, "");
  const url = `${endpoint}/${model}:generateContent`;

  const response = await fetch(url, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "x-goog-api-key": apiKey,
    },
    body: JSON.stringify({
      contents: [
        {
          role: "user",
          parts: [{ text: prompt }],
        },
      ],
      generationConfig: {
        temperature: 0.1,
        maxOutputTokens,
      },
    }),
    signal: AbortSignal.timeout(timeoutMs),
  });

  if (!response.ok) {
    const errorSnippet = (await response.text()).slice(0, 300);
    console.error(
      JSON.stringify({
        message: "Gemini API HTTP error",
        status: response.status,
        bodySnippet: errorSnippet,
      }),
    );
    throw new Error(`Gemini API HTTP error: ${response.status}`);
  }

  const data = (await response.json()) as GeminiResponse;
  const content = data.candidates?.[0]?.content?.parts?.[0]?.text;
  if (typeof content !== "string" || content.trim() === "") {
    throw new Error("Gemini API returned empty content.");
  }

  return content;
}

async function translateSingleWithGemini(env: Env, text: string): Promise<string> {
  const prompt =
    "You are an executive ATS resume translator. Translate the following Indonesian resume text into impactful, professional English using strong action verbs. Convert any Indonesian month names (e.g. Agu -> Aug, Okt -> Oct, Des -> Dec) and status terms (e.g. Seumur Hidup -> Lifetime, Sekarang -> Present). Return ONLY the translated sentence:\n\n" +
    text;

  const content = await callGemini(env, prompt, 2048, 25_000);
  return translateIndonesianDate(content.trim());
}

async function translateBatchWithGemini(
  env: Env,
  map: Record<string, string>,
): Promise<Record<string, string>> {
  const inputJson = JSON.stringify(map, null, 2);
  const prompt = `You are an executive ATS resume translator. Translate each JSON value from Indonesian to high-impact professional English using strong action verbs (e.g. Spearheaded, Engineered, Architected, Optimized).
Requirements:
1. Translate all Indonesian month names and abbreviations to standard English (e.g. 'Agu 2023' -> 'Aug 2023', 'Okt 2023' -> 'Oct 2023', 'Des' -> 'Dec', 'Mei' -> 'May').
2. Translate validity/duration terms to English (e.g. 'Seumur Hidup' -> 'Lifetime', 'Sekarang' or 'Saat ini' -> 'Present').
3. Translate location names appropriately (e.g. 'Jakarta Selatan' -> 'South Jakarta').
4. Maintain the exact JSON keys and structure. Return ONLY a valid JSON object matching the exact input keys without extra commentary.

Input JSON:
${inputJson}`;

  const content = await callGemini(env, prompt, 4096, 35_000);
  return cleanAndDecodeJson(content);
}

export async function handleTranslateAi(request: Request, env: Env): Promise<Response> {
  if (!isAllowedSameOrigin(request)) {
    return jsonResponse(
      {
        success: false,
        message: "Forbidden cross-origin request.",
      },
      403,
    );
  }

  let body: TranslateRequestBody;
  try {
    body = (await request.json()) as TranslateRequestBody;
  } catch {
    return jsonResponse(
      {
        success: false,
        message: "Invalid JSON payload.",
      },
      422,
    );
  }

  if (!isPlainObject(body)) {
    return jsonResponse(
      {
        success: false,
        message: 'Invalid payload. Either "cv" or "text" must be provided.',
      },
      422,
    );
  }

  const hasText = body.text !== undefined && body.text !== null && body.text !== "";
  const hasCv = body.cv !== undefined && body.cv !== null;

  if (!hasText && !hasCv) {
    return jsonResponse(
      {
        success: false,
        message: 'Invalid payload. Either "cv" or "text" must be provided.',
      },
      422,
    );
  }

  if (hasText) {
    if (typeof body.text !== "string" || body.text.length > MAX_SINGLE_TEXT_LENGTH) {
      return jsonResponse(
        {
          success: false,
          message: `Field "text" must be a string up to ${MAX_SINGLE_TEXT_LENGTH} characters.`,
        },
        422,
      );
    }
  }

  if (hasCv && !isPlainObject(body.cv)) {
    return jsonResponse(
      {
        success: false,
        message: 'Field "cv" must be a valid object.',
      },
      422,
    );
  }

  let flattened: Record<string, string> = {};
  if (hasCv && isPlainObject(body.cv)) {
    flattened = extractTranslatableMap(body.cv as CvPayload);
    const entries = Object.entries(flattened);
    if (entries.length > MAX_BATCH_FIELDS) {
      return jsonResponse(
        {
          success: false,
          message: `CV payload exceeds maximum ${MAX_BATCH_FIELDS} translatable fields.`,
        },
        422,
      );
    }

    const totalChars = entries.reduce((sum, [, val]) => sum + val.length, 0);
    if (totalChars > MAX_BATCH_TOTAL_CHARS) {
      return jsonResponse(
        {
          success: false,
          message: `CV payload exceeds maximum ${MAX_BATCH_TOTAL_CHARS} total characters.`,
        },
        422,
      );
    }
  }

  const apiKey = (env.GEMINI_API_KEY ?? "").trim();
  if (apiKey === "") {
    return jsonResponse(
      {
        success: false,
        message: "Google Gemini API key is not configured.",
        fallback: true,
      },
      503,
    );
  }

  if (hasText && typeof body.text === "string") {
    try {
      const translated = await translateSingleWithGemini(env, body.text);
      return jsonResponse({
        success: true,
        translated,
        provider: "gemini",
      });
    } catch (error) {
      console.error(
        JSON.stringify({
          message: "Gemini single text translation failed",
          error: error instanceof Error ? error.message : String(error),
        }),
      );
      return jsonResponse(
        {
          success: false,
          message: "Failed to translate single text with Gemini.",
          fallback: true,
        },
        500,
      );
    }
  }

  const cvPayload = body.cv as CvPayload;
  if (Object.keys(flattened).length === 0) {
    return jsonResponse({
      success: true,
      cv: sanitizeAllDatesInCv(cvPayload),
      provider: "gemini",
    });
  }

  try {
    const translatedMap = await translateBatchWithGemini(env, flattened);
    const translatedCv = applyTranslatedMap(cvPayload, translatedMap);
    return jsonResponse({
      success: true,
      cv: translatedCv,
      provider: "gemini",
    });
  } catch (error) {
    console.error(
      JSON.stringify({
        message: "Gemini batch CV translation failed",
        error: error instanceof Error ? error.message : String(error),
      }),
    );
    return jsonResponse(
      {
        success: false,
        message: "Failed to translate CV with Gemini.",
        fallback: true,
      },
      500,
    );
  }
}
