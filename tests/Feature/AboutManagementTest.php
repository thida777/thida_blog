<?php

namespace Tests\Feature;

use App\Models\AboutPage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AboutManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_and_update_about_page_content(): void
    {
        $admin = User::factory()->create();

        AboutPage::create([
            'title' => 'About Thida Blog',
            'intro' => 'Original intro text.',
            'content' => 'Original content body.',
        ]);

        $this->actingAs($admin)
            ->get(route('admin.about.index'))
            ->assertOk()
            ->assertSee('About Thida Blog')
            ->assertSee('Original intro text.');

        $this->actingAs($admin)
            ->put(route('admin.about.update'), [
                'title' => 'Updated About Title',
                'intro' => 'Updated intro text.',
                'content' => 'Updated content body.',
            ])
            ->assertRedirect(route('admin.about.index'));

        $this->assertDatabaseHas('about_pages', [
            'title' => 'Updated About Title',
            'intro' => 'Updated intro text.',
            'content' => 'Updated content body.',
        ]);

        $this->get(route('about'))
            ->assertOk()
            ->assertSee('Updated About Title')
            ->assertSee('Updated intro text.')
            ->assertSee('Updated content body.');
    }
}
