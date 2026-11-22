<?php

declare(strict_types=1);

namespace Tests\Feature;

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
    }

    public function test_legacy_routes_redirect_to_editor(): void
    {
        $this->get('/login')->assertRedirect('/');
        $this->get('/register')->assertRedirect('/');
        $this->get('/dashboard')->assertRedirect('/');
        $this->get('/cv/save')->assertRedirect('/');
    }
}
