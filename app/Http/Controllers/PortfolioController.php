<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PortfolioController extends Controller
{
    public function index()
    {
        $profile = Profile::first();

        $experiences = Experience::orderByDesc('is_current')
            ->orderByDesc('start_date')
            ->orderBy('sort_order')
            ->get();

        $projects = Project::with('skills')
            ->where('status', 'published')
            ->orderByDesc('featured')
            ->orderBy('sort_order')
            ->orderByDesc('created_at')
            ->get();

        $skills = Skill::orderBy('category')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('category');

        $educations = Education::orderByDesc('end_date')
            ->orderBy('sort_order')
            ->get();

        $socialLinks = SocialLink::where('is_visible', true)
            ->orderBy('sort_order')
            ->get();

        return view('portfolio.index', compact(
            'profile',
            'experiences',
            'projects',
            'skills',
            'educations',
            'socialLinks'
        ));
    }

    public function robots()
    {
        $content = "User-agent: *\n"
            . "Allow: /\n"
            . "Disallow: /admin\n"
            . "\n"
            . 'Sitemap: ' . url('/sitemap.xml') . "\n";

        return response($content)->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap()
    {
        $lastmod = collect([
            Profile::max('updated_at'),
            Experience::max('updated_at'),
            Project::max('updated_at'),
            Education::max('updated_at'),
            Skill::max('updated_at'),
            SocialLink::max('updated_at'),
        ])->filter()->max();

        $content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n"
            . '  <url>' . "\n"
            . '    <loc>' . e(url('/')) . '</loc>' . "\n"
            . ($lastmod ? '    <lastmod>' . date('Y-m-d', strtotime($lastmod)) . '</lastmod>' . "\n" : '')
            . '    <changefreq>weekly</changefreq>' . "\n"
            . '    <priority>1.0</priority>' . "\n"
            . '  </url>' . "\n"
            . '</urlset>' . "\n";

        return response($content)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function downloadCv()
    {
        $profile = Profile::first();

        if (! $profile || ! $profile->cv_file) {
            abort(404);
        }

        $filename = Str::slug($profile->name) . '-CV.pdf';

        return Storage::disk('public')->download($profile->cv_file, $filename);
    }
}