<?php

declare(strict_types=1);

namespace App\Http\Controllers\Cv;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

final class AiTranslateCvController extends Controller
{
    /**
     * Menerjemahkan dan memoles isi CV ke Bahasa Inggris standar ATS menggunakan Google Gemini AI.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'cv' => ['nullable', 'array'],
            'text' => ['nullable', 'string', 'max:5000'],
        ]);

        $apiKey = (string) config('services.gemini.api_key');
        if (empty($apiKey)) {
            return response()->json([
                'success' => false,
                'message' => 'Google Gemini API key is not configured.',
                'fallback' => true,
            ], 503);
        }

        // Mode 1: Terjemahkan satu kalimat / bullet point tunggal
        if (! empty($validated['text'])) {
            try {
                $translated = $this->translateSingleWithGemini($validated['text']);

                return response()->json([
                    'success' => true,
                    'translated' => $translated,
                    'provider' => 'gemini',
                ]);
            } catch (\Throwable $e) {
                Log::warning('Gemini single text translation failed: '.$e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to translate single text with Gemini: '.$e->getMessage(),
                    'fallback' => true,
                ], 500);
            }
        }

        // Mode 2: Terjemahkan seluruh objek CV dalam 1 batch call yang efisien
        if (! empty($validated['cv'])) {
            try {
                $cv = $validated['cv'];
                $flattened = $this->extractTranslatableMap($cv);

                if (empty($flattened)) {
                    return response()->json([
                        'success' => true,
                        'cv' => $this->sanitizeAllDatesInCv($cv),
                        'provider' => 'gemini',
                    ]);
                }

                $translatedMap = $this->translateBatchWithGemini($flattened);
                $translatedCv = $this->applyTranslatedMap($cv, $translatedMap);

                return response()->json([
                    'success' => true,
                    'cv' => $translatedCv,
                    'provider' => 'gemini',
                ]);
            } catch (\Throwable $e) {
                Log::warning('Gemini batch CV translation failed: '.$e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'Failed to translate CV with Gemini: '.$e->getMessage(),
                    'fallback' => true,
                ], 500);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid payload. Either "cv" or "text" must be provided.',
        ], 422);
    }

    /**
     * Terjemahkan single text menggunakan Google Gemini.
     */
    private function translateSingleWithGemini(string $text): string
    {
        $apiKey = (string) config('services.gemini.api_key');
        $model = (string) config('services.gemini.model', 'gemini-3-flash-preview');
        $endpoint = rtrim((string) config('services.gemini.endpoint', 'https://generativelanguage.googleapis.com/v1beta/models'), '/');
        $url = "{$endpoint}/{$model}:generateContent?key={$apiKey}";

        $prompt = "You are an executive ATS resume translator. Translate the following Indonesian resume text into impactful, professional English using strong action verbs. Convert any Indonesian month names (e.g. Agu -> Aug, Okt -> Oct, Des -> Dec) and status terms (e.g. Seumur Hidup -> Lifetime, Sekarang -> Present). Return ONLY the translated sentence:\n\n".$text;

        $response = Http::timeout(25)->post($url, [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.1,
                'maxOutputTokens' => 2048,
            ],
        ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Gemini API HTTP error: '.$response->status().' - '.$response->body());
        }

        $content = (string) $response->json('candidates.0.content.parts.0.text');

        return $this->translateIndonesianDate(trim($content));
    }

    /**
     * Terjemahkan batch map menggunakan Google Gemini.
     *
     * @param  array<string, string>  $map
     * @return array<string, string>
     */
    private function translateBatchWithGemini(array $map): array
    {
        $apiKey = (string) config('services.gemini.api_key');
        $model = (string) config('services.gemini.model', 'gemini-3-flash-preview');
        $endpoint = rtrim((string) config('services.gemini.endpoint', 'https://generativelanguage.googleapis.com/v1beta/models'), '/');
        $url = "{$endpoint}/{$model}:generateContent?key={$apiKey}";

        $inputJson = json_encode($map, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

        $prompt = "You are an executive ATS resume translator. Translate each JSON value from Indonesian to high-impact professional English using strong action verbs (e.g. Spearheaded, Engineered, Architected, Optimized).
Requirements:
1. Translate all Indonesian month names and abbreviations to standard English (e.g. 'Agu 2023' -> 'Aug 2023', 'Okt 2023' -> 'Oct 2023', 'Des' -> 'Dec', 'Mei' -> 'May').
2. Translate validity/duration terms to English (e.g. 'Seumur Hidup' -> 'Lifetime', 'Sekarang' or 'Saat ini' -> 'Present').
3. Translate location names appropriately (e.g. 'Jakarta Selatan' -> 'South Jakarta').
4. Maintain the exact JSON keys and structure. Return ONLY a valid JSON object matching the exact input keys without extra commentary.

Input JSON:
".$inputJson;

        $response = Http::timeout(35)->post($url, [
            'contents' => [
                [
                    'role' => 'user',
                    'parts' => [
                        [
                            'text' => $prompt,
                        ],
                    ],
                ],
            ],
            'generationConfig' => [
                'temperature' => 0.1,
                'maxOutputTokens' => 4096,
            ],
        ]);

        if (! $response->successful()) {
            throw new \RuntimeException('Gemini API HTTP error: '.$response->status().' - '.$response->body());
        }

        $content = (string) $response->json('candidates.0.content.parts.0.text');

        return $this->cleanAndDecodeJson($content);
    }

    /**
     * Membersihkan markdown format ```json ... ``` dan mendecode JSON.
     *
     * @return array<string, string>
     */
    private function cleanAndDecodeJson(string $content): array
    {
        $cleanJson = trim($content);

        if (str_starts_with($cleanJson, '```json')) {
            $cleanJson = trim(substr($cleanJson, 7));
        } elseif (str_starts_with($cleanJson, '```')) {
            $cleanJson = trim(substr($cleanJson, 3));
        }

        if (str_ends_with($cleanJson, '```')) {
            $cleanJson = trim(substr($cleanJson, 0, -3));
        }

        $decoded = json_decode($cleanJson, true);

        if (! is_array($decoded)) {
            Log::warning('Gemini output could not be parsed as JSON: '.$content);
            throw new \RuntimeException('Gemini returned invalid JSON.');
        }

        return $decoded;
    }

    /**
     * Ekstrak teks-teks yang perlu diterjemahkan ke dalam mapping key-value sederhana.
     * Termasuk judul, ringkasan, peluru pengalaman, sertifikasi, tanggal (bulan), dan lokasi.
     *
     * @param  array<string, mixed>  $cv
     * @return array<string, string>
     */
    private function extractTranslatableMap(array $cv): array
    {
        $map = [];

        // 1. Personal
        if (! empty($cv['personal']['jobTitle'])) {
            $map['job_title'] = (string) $cv['personal']['jobTitle'];
        }
        if (! empty($cv['personal']['summary'])) {
            $map['summary'] = (string) $cv['personal']['summary'];
        }
        if (! empty($cv['personal']['location'])) {
            $map['location'] = (string) $cv['personal']['location'];
        }

        // 2. Experiences
        if (! empty($cv['experiences']) && is_array($cv['experiences'])) {
            foreach ($cv['experiences'] as $idx => $exp) {
                if (! empty($exp['position'])) {
                    $map["exp_{$idx}_position"] = (string) $exp['position'];
                }
                if (! empty($exp['location'])) {
                    $map["exp_{$idx}_location"] = (string) $exp['location'];
                }
                if (! empty($exp['startDate'])) {
                    $map["exp_{$idx}_start"] = (string) $exp['startDate'];
                }
                if (! empty($exp['endDate'])) {
                    $map["exp_{$idx}_end"] = (string) $exp['endDate'];
                }
                if (! empty($exp['bullets']) && is_array($exp['bullets'])) {
                    foreach ($exp['bullets'] as $bIdx => $bullet) {
                        if (! empty(trim((string) $bullet))) {
                            $map["exp_{$idx}_bullet_{$bIdx}"] = (string) $bullet;
                        }
                    }
                }
            }
        }

        // 3. Educations
        if (! empty($cv['educations']) && is_array($cv['educations'])) {
            foreach ($cv['educations'] as $idx => $edu) {
                if (! empty($edu['degree'])) {
                    $map["edu_{$idx}_degree"] = (string) $edu['degree'];
                }
                if (! empty($edu['location'])) {
                    $map["edu_{$idx}_location"] = (string) $edu['location'];
                }
                if (! empty($edu['startDate'])) {
                    $map["edu_{$idx}_start"] = (string) $edu['startDate'];
                }
                if (! empty($edu['endDate'])) {
                    $map["edu_{$idx}_end"] = (string) $edu['endDate'];
                }
            }
        }

        // 4. Certifications
        if (! empty($cv['certifications']) && is_array($cv['certifications'])) {
            foreach ($cv['certifications'] as $idx => $cert) {
                if (! empty($cert['name'])) {
                    $map["cert_{$idx}_name"] = (string) $cert['name'];
                }
                if (! empty($cert['issuer'])) {
                    $map["cert_{$idx}_issuer"] = (string) $cert['issuer'];
                }
                if (! empty($cert['issueDate'])) {
                    $map["cert_{$idx}_issue"] = (string) $cert['issueDate'];
                }
                if (! empty($cert['expiryDate'])) {
                    $map["cert_{$idx}_expiry"] = (string) $cert['expiryDate'];
                }
            }
        }

        // 5. Projects
        if (! empty($cv['projects']) && is_array($cv['projects'])) {
            foreach ($cv['projects'] as $idx => $proj) {
                if (! empty($proj['role'])) {
                    $map["proj_{$idx}_role"] = (string) $proj['role'];
                }
                if (! empty($proj['description'])) {
                    $map["proj_{$idx}_desc"] = (string) $proj['description'];
                }
            }
        }

        // 6. Trainings
        if (! empty($cv['trainings']) && is_array($cv['trainings'])) {
            foreach ($cv['trainings'] as $idx => $train) {
                if (! empty($train['title'])) {
                    $map["train_{$idx}_title"] = (string) $train['title'];
                }
                if (! empty($train['field'])) {
                    $map["train_{$idx}_field"] = (string) $train['field'];
                }
                if (! empty($train['subField'])) {
                    $map["train_{$idx}_subfield"] = (string) $train['subField'];
                }
                if (! empty($train['location'])) {
                    $map["train_{$idx}_location"] = (string) $train['location'];
                }
                if (! empty($train['startDate'])) {
                    $map["train_{$idx}_start"] = (string) $train['startDate'];
                }
                if (! empty($train['endDate'])) {
                    $map["train_{$idx}_end"] = (string) $train['endDate'];
                }
                if (! empty($train['description'])) {
                    $map["train_{$idx}_desc"] = (string) $train['description'];
                }
            }
        }

        return $map;
    }

    /**
     * Terapkan hasil terjemahan kembali ke dalam struktur array CV asli.
     * Memastikan semua tanggal dan bulan juga dinormalisasi dengan translateIndonesianDate.
     *
     * @param  array<string, mixed>  $cv
     * @param  array<string, string>  $translatedMap
     * @return array<string, mixed>
     */
    private function applyTranslatedMap(array $cv, array $translatedMap): array
    {
        // 1. Personal
        if (isset($translatedMap['job_title'])) {
            $cv['personal']['jobTitle'] = $translatedMap['job_title'];
        }
        if (isset($translatedMap['summary'])) {
            $cv['personal']['summary'] = $translatedMap['summary'];
        }
        if (isset($translatedMap['location'])) {
            $cv['personal']['location'] = $translatedMap['location'];
        }

        // 2. Experiences
        if (! empty($cv['experiences']) && is_array($cv['experiences'])) {
            foreach ($cv['experiences'] as $idx => &$exp) {
                if (isset($translatedMap["exp_{$idx}_position"])) {
                    $exp['position'] = $translatedMap["exp_{$idx}_position"];
                }
                if (isset($translatedMap["exp_{$idx}_location"])) {
                    $exp['location'] = $translatedMap["exp_{$idx}_location"];
                }
                if (isset($translatedMap["exp_{$idx}_start"])) {
                    $exp['startDate'] = $this->translateIndonesianDate($translatedMap["exp_{$idx}_start"]);
                } elseif (! empty($exp['startDate'])) {
                    $exp['startDate'] = $this->translateIndonesianDate($exp['startDate']);
                }
                if (isset($translatedMap["exp_{$idx}_end"])) {
                    $exp['endDate'] = $this->translateIndonesianDate($translatedMap["exp_{$idx}_end"]);
                } elseif (! empty($exp['endDate'])) {
                    $exp['endDate'] = $this->translateIndonesianDate($exp['endDate']);
                }
                if (! empty($exp['bullets']) && is_array($exp['bullets'])) {
                    foreach ($exp['bullets'] as $bIdx => &$bullet) {
                        if (isset($translatedMap["exp_{$idx}_bullet_{$bIdx}"])) {
                            $bullet = $translatedMap["exp_{$idx}_bullet_{$bIdx}"];
                        }
                    }
                }
            }
            unset($exp, $bullet);
        }

        // 3. Educations
        if (! empty($cv['educations']) && is_array($cv['educations'])) {
            foreach ($cv['educations'] as $idx => &$edu) {
                if (isset($translatedMap["edu_{$idx}_degree"])) {
                    $edu['degree'] = $translatedMap["edu_{$idx}_degree"];
                }
                if (isset($translatedMap["edu_{$idx}_location"])) {
                    $edu['location'] = $translatedMap["edu_{$idx}_location"];
                }
                if (isset($translatedMap["edu_{$idx}_start"])) {
                    $edu['startDate'] = $this->translateIndonesianDate($translatedMap["edu_{$idx}_start"]);
                } elseif (! empty($edu['startDate'])) {
                    $edu['startDate'] = $this->translateIndonesianDate($edu['startDate']);
                }
                if (isset($translatedMap["edu_{$idx}_end"])) {
                    $edu['endDate'] = $this->translateIndonesianDate($translatedMap["edu_{$idx}_end"]);
                } elseif (! empty($edu['endDate'])) {
                    $edu['endDate'] = $this->translateIndonesianDate($edu['endDate']);
                }
            }
            unset($edu);
        }

        // 4. Certifications
        if (! empty($cv['certifications']) && is_array($cv['certifications'])) {
            foreach ($cv['certifications'] as $idx => &$cert) {
                if (isset($translatedMap["cert_{$idx}_name"])) {
                    $cert['name'] = $translatedMap["cert_{$idx}_name"];
                }
                if (isset($translatedMap["cert_{$idx}_issuer"])) {
                    $cert['issuer'] = $translatedMap["cert_{$idx}_issuer"];
                }
                if (isset($translatedMap["cert_{$idx}_issue"])) {
                    $cert['issueDate'] = $this->translateIndonesianDate($translatedMap["cert_{$idx}_issue"]);
                } elseif (! empty($cert['issueDate'])) {
                    $cert['issueDate'] = $this->translateIndonesianDate($cert['issueDate']);
                }
                if (isset($translatedMap["cert_{$idx}_expiry"])) {
                    $cert['expiryDate'] = $this->translateIndonesianDate($translatedMap["cert_{$idx}_expiry"]);
                } elseif (! empty($cert['expiryDate'])) {
                    $cert['expiryDate'] = $this->translateIndonesianDate($cert['expiryDate']);
                }
            }
            unset($cert);
        }

        // 5. Projects
        if (! empty($cv['projects']) && is_array($cv['projects'])) {
            foreach ($cv['projects'] as $idx => &$proj) {
                if (isset($translatedMap["proj_{$idx}_role"])) {
                    $proj['role'] = $translatedMap["proj_{$idx}_role"];
                }
                if (isset($translatedMap["proj_{$idx}_desc"])) {
                    $proj['description'] = $translatedMap["proj_{$idx}_desc"];
                }
            }
            unset($proj);
        }

        // 6. Trainings
        if (! empty($cv['trainings']) && is_array($cv['trainings'])) {
            foreach ($cv['trainings'] as $idx => &$train) {
                if (isset($translatedMap["train_{$idx}_title"])) {
                    $train['title'] = $translatedMap["train_{$idx}_title"];
                }
                if (isset($translatedMap["train_{$idx}_field"])) {
                    $train['field'] = $translatedMap["train_{$idx}_field"];
                }
                if (isset($translatedMap["train_{$idx}_subfield"])) {
                    $train['subField'] = $translatedMap["train_{$idx}_subfield"];
                }
                if (isset($translatedMap["train_{$idx}_location"])) {
                    $train['location'] = $translatedMap["train_{$idx}_location"];
                }
                if (isset($translatedMap["train_{$idx}_start"])) {
                    $train['startDate'] = $this->translateIndonesianDate($translatedMap["train_{$idx}_start"]);
                } elseif (! empty($train['startDate'])) {
                    $train['startDate'] = $this->translateIndonesianDate($train['startDate']);
                }
                if (isset($translatedMap["train_{$idx}_end"])) {
                    $train['endDate'] = $this->translateIndonesianDate($translatedMap["train_{$idx}_end"]);
                } elseif (! empty($train['endDate'])) {
                    $train['endDate'] = $this->translateIndonesianDate($train['endDate']);
                }
                if (isset($translatedMap["train_{$idx}_desc"])) {
                    $train['description'] = $translatedMap["train_{$idx}_desc"];
                }
            }
            unset($train);
        }

        return $cv;
    }

    /**
     * Sanitasi semua tanggal dalam CV ke format Bahasa Inggris standar.
     *
     * @param  array<string, mixed>  $cv
     * @return array<string, mixed>
     */
    private function sanitizeAllDatesInCv(array $cv): array
    {
        if (! empty($cv['experiences']) && is_array($cv['experiences'])) {
            foreach ($cv['experiences'] as &$exp) {
                if (! empty($exp['startDate'])) {
                    $exp['startDate'] = $this->translateIndonesianDate($exp['startDate']);
                }
                if (! empty($exp['endDate'])) {
                    $exp['endDate'] = $this->translateIndonesianDate($exp['endDate']);
                }
            }
            unset($exp);
        }

        if (! empty($cv['educations']) && is_array($cv['educations'])) {
            foreach ($cv['educations'] as &$edu) {
                if (! empty($edu['startDate'])) {
                    $edu['startDate'] = $this->translateIndonesianDate($edu['startDate']);
                }
                if (! empty($edu['endDate'])) {
                    $edu['endDate'] = $this->translateIndonesianDate($edu['endDate']);
                }
            }
            unset($edu);
        }

        if (! empty($cv['certifications']) && is_array($cv['certifications'])) {
            foreach ($cv['certifications'] as &$cert) {
                if (! empty($cert['issueDate'])) {
                    $cert['issueDate'] = $this->translateIndonesianDate($cert['issueDate']);
                }
                if (! empty($cert['expiryDate'])) {
                    $cert['expiryDate'] = $this->translateIndonesianDate($cert['expiryDate']);
                }
            }
            unset($cert);
        }

        if (! empty($cv['trainings']) && is_array($cv['trainings'])) {
            foreach ($cv['trainings'] as &$train) {
                if (! empty($train['startDate'])) {
                    $train['startDate'] = $this->translateIndonesianDate($train['startDate']);
                }
                if (! empty($train['endDate'])) {
                    $train['endDate'] = $this->translateIndonesianDate($train['endDate']);
                }
            }
            unset($train);
        }

        return $cv;
    }

    /**
     * Konversi nama bulan dan istilah tanggal Bahasa Indonesia ke Bahasa Inggris standar.
     * Contoh: "Agu 2023" -> "Aug 2023", "Okt 2023" -> "Oct 2023", "Seumur Hidup" -> "Lifetime"
     */
    private function translateIndonesianDate(string $date): string
    {
        $text = trim($date);
        if ($text === '') {
            return $text;
        }

        // Istilah khusus durasi / masa berlaku
        $specials = [
            '/\bseumur\s*hidup\b/ui' => 'Lifetime',
            '/\b(sekarang|saat\s*ini)\b/ui' => 'Present',
            '/\btanpa\s*kedaluwarsa\b/ui' => 'No Expiration',
            '/\btanpa\s*batas\s*waktu\b/ui' => 'Permanent',
        ];
        foreach ($specials as $pattern => $replacement) {
            $text = (string) preg_replace($pattern, $replacement, $text);
        }

        // Nama bulan (lengkap dan singkatan umum Bahasa Indonesia)
        $months = [
            '/\b(agu|agt|agustus)\b/ui' => 'Aug',
            '/\b(okt|oktober)\b/ui' => 'Oct',
            '/\b(des|desember)\b/ui' => 'Dec',
            '/\b(mei)\b/ui' => 'May',
            '/\b(maret|mar)\b/ui' => 'Mar',
            '/\b(januari|jan)\b/ui' => 'Jan',
            '/\b(februari|feb)\b/ui' => 'Feb',
            '/\b(april|apr)\b/ui' => 'Apr',
            '/\b(juni|jun)\b/ui' => 'Jun',
            '/\b(juli|jul)\b/ui' => 'Jul',
            '/\b(september|sep)\b/ui' => 'Sep',
            '/\b(nopember|nop|november|nov)\b/ui' => 'Nov',
        ];
        foreach ($months as $pattern => $replacement) {
            $text = (string) preg_replace($pattern, $replacement, $text);
        }

        return $text;
    }
}
