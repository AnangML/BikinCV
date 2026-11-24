import { bindings, defineConfig } from "cf/config";

/**
 * Secret-like files were detected but not read or migrated: .dev.vars.example. Only `secrets.required` entries are migrated.
 * @see https://developers.cloudflare.com/workers/configuration/secrets/
 */

export default defineConfig({
	worker: {
		name: "bikincv",
		compatibilityDate: "2026-11-24",
		compatibilityFlags: [
			"nodejs_compat",
		],
		entrypoint: "worker/index.ts",
		observability: {
			enabled: true,
			logs: {
				enabled: true,
				headSamplingRate: 1,
			},
			traces: {
				enabled: true,
				headSamplingRate: 0.01,
			},
		},
		assets: {
			notFoundHandling: "single-page-application",
			runWorkerFirst: [
				"/cv/*",
				"/up",
				"/login",
				"/register",
				"/dashboard",
			],
		},
		env: {
			GEMINI_MODEL: bindings.text("gemini-3-flash-preview"),
			GEMINI_ENDPOINT: bindings.text("https://generativelanguage.googleapis.com/v1beta/models"),
			ASSETS: bindings.assets(),
		},
	},
});
