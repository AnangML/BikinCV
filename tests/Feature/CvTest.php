<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Cv;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

final class CvTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_access_editor_page(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Bikin');
    }

    public function test_cv_can_be_saved_via_api(): void
    {
        $payload = [
            'title' => 'Software Engineer CV',
            'content' => [
                'personal' => ['fullName' => 'Budi Test', 'email' => 'budi@test.com'],
                'experiences' => [],
                'educations' => [],
                'skills' => ['languages' => ['PHP']],
            ],
            'template_id' => 'classic',
            'selected_font' => 'inter',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'ats_score' => 85,
        ];

        $response = $this->postJson('/cv/save', $payload);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $this->assertDatabaseHas('cvs', [
            'title' => 'Software Engineer CV',
            'template_id' => 'classic',
        ]);
    }

    public function test_cv_can_be_loaded_in_editor_by_id(): void
    {
        $cv = Cv::create([
            'title' => 'Sample CV for Preview',
            'slug' => 'sample-cv-preview-xyz999',
            'template_id' => 'modern',
            'selected_font' => 'inter',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'content' => [
                'personal' => ['fullName' => 'Siti Nurhaliza', 'jobTitle' => 'Product Designer'],
            ],
            'ats_score' => 92,
            'is_public' => true,
        ]);

        $response = $this->get('/?id='.$cv->id);

        $response->assertStatus(200);
        $response->assertSee('Siti Nurhaliza');
    }

    public function test_legacy_auth_routes_redirect_to_editor(): void
    {
        $this->get('/login')->assertRedirect('/');
        $this->get('/register')->assertRedirect('/');
        $this->get('/dashboard')->assertRedirect('/');
    }
}
