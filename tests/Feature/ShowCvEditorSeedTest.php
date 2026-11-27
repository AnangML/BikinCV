<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class ShowCvEditorSeedTest extends TestCase
{
    use RefreshDatabase;

    public function test_editor_loads_seeded_cv_when_seed_slug_matches(): void
    {
        $cv = Cv::query()->create([
            'user_id' => null,
            'title' => 'Seeded Developer CV',
            'slug' => 'seeded-developer-cv',
            'template_id' => 'corporate',
            'selected_font' => 'inter',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'content' => [
                'personal' => [
                    'fullName' => 'Test Candidate',
                    'jobTitle' => 'Backend Engineer',
                ],
                'experiences' => [],
                'educations' => [],
                'skills' => ['languages' => ['PHP'], 'frameworks' => [], 'databases' => [], 'tools' => []],
                'certifications' => [],
                'projects' => [],
                'trainings' => [],
                'languages' => [],
            ],
            'ats_score' => 90,
            'is_public' => false,
        ]);

        $response = $this->get('/?seed='.$cv->slug);

        $response->assertOk();
        $response->assertViewIs('cv-editor');
        $response->assertViewHas('seededCv', function (?array $seededCv) use ($cv): bool {
            return is_array($seededCv)
                && ($seededCv['title'] ?? null) === $cv->title
                && ($seededCv['selectedTemplate'] ?? null) === 'corporate'
                && ($seededCv['cv']['personal']['fullName'] ?? null) === 'Test Candidate';
        });
    }

    public function test_editor_returns_null_seeded_cv_when_seed_slug_does_not_exist(): void
    {
        $response = $this->get('/?seed=non-existent-slug');

        $response->assertOk();
        $response->assertViewIs('cv-editor');
        $response->assertViewHas('seededCv', null);
    }
}
