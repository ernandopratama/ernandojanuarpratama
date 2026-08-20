<?php

namespace Tests\Feature;

use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductionFeaturesTest extends TestCase
{
    use RefreshDatabase;

    public function test_robots_txt_is_served(): void
    {
        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('User-agent: *')
            ->assertSee('Disallow: /admin')
            ->assertSee('Sitemap: ' . url('/sitemap.xml'));
    }

    public function test_sitemap_xml_is_served(): void
    {
        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false)
            ->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">', false)
            ->assertSee('<loc>' . e(url('/')) . '</loc>', false);
    }

    public function test_sitemap_includes_lastmod_from_content(): void
    {
        Profile::factory()->create(['updated_at' => now()->subDay()]);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertSee('<lastmod>', false);
    }

    public function test_cv_download_works_when_file_exists(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('cv/sample-cv.pdf', '%PDF-1.4 test');

        Profile::factory()->create(['name' => 'Ernando Januar Pratama', 'cv_file' => 'cv/sample-cv.pdf']);

        $response = $this->get('/cv');

        $response->assertOk();
        $this->assertStringContainsString('attachment', $response->headers->get('Content-Disposition'));
        $this->assertStringContainsString('ernando-januar-pratama-CV.pdf', $response->headers->get('Content-Disposition'));
    }

    public function test_cv_download_returns_404_without_file(): void
    {
        $this->get('/cv')->assertNotFound();
    }

    public function test_security_headers_are_present_on_public_pages(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');
    }

    public function test_seo_and_open_graph_meta_are_present(): void
    {
        Profile::factory()->create([
            'name' => 'Ernando Januar Pratama',
            'short_bio' => 'Description for search engines.',
            'email' => 'hello@example.com',
            'location' => 'Indonesia',
        ]);

        $this->get('/')
            ->assertOk()
            ->assertSee('<meta name="description"', false)
            ->assertSee('<link rel="canonical"', false)
            ->assertSee('property="og:type"', false)
            ->assertSee('property="og:image"', false)
            ->assertSee('name="twitter:card"', false)
            ->assertSee('application/ld+json', false)
            ->assertSee('sameAs', false);
    }
}