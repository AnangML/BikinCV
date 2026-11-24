/**
 * Deklarasi secret runtime yang tidak disimpan di wrangler.jsonc.
 * Binding & vars lainnya di-generate otomatis ke worker-configuration.d.ts oleh `npm run cf-typegen`.
 */
interface Env {
  GEMINI_API_KEY?: string;
}
