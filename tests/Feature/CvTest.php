<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Cv;
use App\Models\User;
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

    public function test_authenticated_user_can_view_dashboard_and_cvs(): void
    {
        $user = User::factory()->create();

        Cv::create([
            'user_id' => $user->id,
            'title' => 'My First Resume',
            'slug' => 'my-first-resume-abc123',
            'template_id' => 'classic',
            'selected_font' => 'inter',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'content' => ['personal' => ['fullName' => 'User Test']],
            'ats_score' => 90,
            'is_public' => false,
        ]);

        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(200);
        $response->assertSee('My First Resume');
        $response->assertSee('90% ATS');
    }

    public function test_user_can_duplicate_cv(): void
    {
        $user = User::factory()->create();

        $cv = Cv::create([
            'user_id' => $user->id,
            'title' => 'Frontend Resume',
            'slug' => 'frontend-resume-abc123',
            'template_id' => 'modern',
            'selected_font' => 'roboto',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'content' => ['personal' => ['fullName' => 'Frontend Dev']],
            'ats_score' => 75,
            'is_public' => false,
        ]);

        $response = $this->actingAs($user)->post("/cv/{$cv->id}/duplicate");

        $response->assertRedirect();
        $this->assertDatabaseHas('cvs', [
            'title' => 'Frontend Resume (Salinan)',
            'template_id' => 'modern',
        ]);
    }

    public function test_user_can_delete_cv(): void
    {
        $user = User::factory()->create();

        $cv = Cv::create([
            'user_id' => $user->id,
            'title' => 'CV to Delete',
            'slug' => 'cv-to-delete-abc123',
            'template_id' => 'tech',
            'selected_font' => 'inter',
            'doc_font_size' => 'doc-size-base',
            'accent_color' => '#111827',
            'content' => ['personal' => ['fullName' => 'Delete Me']],
            'ats_score' => 50,
            'is_public' => false,
        ]);

        $response = $this->actingAs($user)->delete("/cv/{$cv->id}");

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('cvs', [
            'id' => $cv->id,
        ]);
    }

    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Budi Santoso',
            'email' => 'budi.santoso@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', [
            'email' => 'budi.santoso@example.com',
        ]);
    }
}
