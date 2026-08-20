<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Project;
use App\Models\Skill;
use App\Models\SocialLink;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'projects' => Project::count(),
            'publishedProjects' => Project::where('status', 'published')->count(),
            'draftProjects' => Project::where('status', 'draft')->count(),
            'experiences' => Experience::count(),
            'skills' => Skill::count(),
            'educations' => Education::count(),
            'socialLinks' => SocialLink::count(),
        ];

        $recentProjects = Project::with('skills')->latest()->take(5)->get();
        $recentExperiences = Experience::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentProjects', 'recentExperiences'));
    }
}