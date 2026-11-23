<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;

final class CvTest extends TestCase
{
    public function test_guest_can_access_editor_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bikin');
        $response->assertSee('Unduh PDF');
        $response->assertSee('The Swiss International (Timeline)');
        $response->assertSee('data-template-id="swiss"', false);
        $response->assertSee('The Bold Header (Foto & Banner)', false);
        $response->assertSee('data-template-id="bold"', false);
        $response->assertSee('The Editorial / Modern Creative', false);
        $response->assertSee('data-template-id="editorial"', false);

        // Verification for Auto Translate & Translation Controls
        $response->assertSee('Auto EN (AI)');
        $response->assertSee('Demo English ATS 🇬🇧', false);
        $response->assertSee('translateAllToEnglish()', false);
        $response->assertSee('restoreOriginalIndonesian()', false);
        $response->assertSee('Bahasa yang Dikuasai');
        $response->assertSee('addLanguage()', false);
    }

    public function test_legacy_routes_redirect_to_editor(): void
    {
        $this->get('/login')->assertRedirect('/');
        $this->get('/register')->assertRedirect('/');
        $this->get('/dashboard')->assertRedirect('/');
        $this->get('/cv/save')->assertRedirect('/');
    }

    public function test_ai_translate_endpoint_validates_payload(): void
    {
        $response = $this->postJson('/cv/translate-ai', []);
        $response->assertStatus(422);
    }

    public function test_ai_translate_endpoint_handles_gemini_single_text(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                ['text' => 'Spearheaded 6 software engineers in payment systems'],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/cv/translate-ai', [
            'text' => 'Memimpin 6 insinyur perangkat lunak sistem pembayaran',
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'translated' => 'Spearheaded 6 software engineers in payment systems',
            'provider' => 'gemini',
        ]);
    }

    public function test_ai_translate_endpoint_translates_dates_and_months(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'job_title' => 'Software Engineer',
                                        'exp_0_start' => 'Agu 2023',
                                        'exp_0_end' => 'Okt 2023',
                                        'cert_0_expiry' => 'Seumur Hidup',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/cv/translate-ai', [
            'cv' => [
                'personal' => [
                    'jobTitle' => 'Rekayasa Perangkat Lunak',
                ],
                'experiences' => [
                    [
                        'position' => 'Developer',
                        'startDate' => 'Agu 2023',
                        'endDate' => 'Okt 2023',
                    ],
                ],
                'certifications' => [
                    [
                        'name' => 'Laravel Certified Developer',
                        'expiryDate' => 'Seumur Hidup',
                    ],
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'cv' => [
                'personal' => [
                    'jobTitle' => 'Software Engineer',
                ],
                'experiences' => [
                    [
                        'startDate' => 'Aug 2023',
                        'endDate' => 'Oct 2023',
                    ],
                ],
                'certifications' => [
                    [
                        'expiryDate' => 'Lifetime',
                    ],
                ],
            ],
            'provider' => 'gemini',
        ]);
    }

    public function test_ai_translate_endpoint_handles_batch_cv(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'job_title' => 'Software Engineering Manager',
                                        'summary' => 'Seasoned software engineer with 6+ years experience.',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/cv/translate-ai', [
            'cv' => [
                'personal' => [
                    'jobTitle' => 'Manajer Rekayasa Perangkat Lunak',
                    'summary' => 'Insinyur perangkat lunak berpengalaman 6+ tahun.',
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'cv' => [
                'personal' => [
                    'jobTitle' => 'Software Engineering Manager',
                    'summary' => 'Seasoned software engineer with 6+ years experience.',
                ],
            ],
            'provider' => 'gemini',
        ]);
    }

    public function test_ai_translate_endpoint_handles_languages(): void
    {
        Http::fake([
            'generativelanguage.googleapis.com/*' => Http::response([
                'candidates' => [
                    [
                        'content' => [
                            'parts' => [
                                [
                                    'text' => json_encode([
                                        'lang_0_name' => 'Indonesian',
                                        'lang_0_level' => 'Native or Bilingual Proficiency',
                                        'lang_0_info' => 'Mother Tongue',
                                        'lang_1_name' => 'English',
                                        'lang_1_level' => 'Full Professional Proficiency',
                                        'lang_1_info' => 'TOEFL ITP: 600',
                                    ]),
                                ],
                            ],
                        ],
                    ],
                ],
            ], 200),
        ]);

        $response = $this->postJson('/cv/translate-ai', [
            'cv' => [
                'languages' => [
                    [
                        'name' => 'Bahasa Indonesia',
                        'level' => 'Penutur Asli',
                        'info' => 'Bahasa Ibu',
                    ],
                    [
                        'name' => 'Bahasa Inggris',
                        'level' => 'Tingkat Kerja Profesional',
                        'info' => 'TOEFL ITP: 600',
                    ],
                ],
            ],
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'cv' => [
                'languages' => [
                    [
                        'name' => 'Indonesian',
                        'level' => 'Native or Bilingual Proficiency',
                        'info' => 'Mother Tongue',
                    ],
                    [
                        'name' => 'English',
                        'level' => 'Full Professional Proficiency',
                        'info' => 'TOEFL ITP: 600',
                    ],
                ],
            ],
            'provider' => 'gemini',
        ]);
    }
}
