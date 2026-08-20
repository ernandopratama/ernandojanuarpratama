<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialLinkRequest;
use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    public function index()
    {
        $socialLinks = SocialLink::orderBy('sort_order')->paginate(10);

        return view('admin.social_links.index', compact('socialLinks'));
    }

    public function create()
    {
        return view('admin.social_links.create', ['socialLink' => new SocialLink()]);
    }

    public function store(SocialLinkRequest $request)
    {
        $data = $request->validated();
        $data['is_visible'] = $request->boolean('is_visible');

        SocialLink::create($data);

        return redirect()
            ->route('admin.social-links.index')
            ->with('success', 'Social link created successfully.');
    }

    public function edit(SocialLink $socialLink)
    {
        return view('admin.social_links.edit', compact('socialLink'));
    }

    public function update(SocialLinkRequest $request, SocialLink $socialLink)
    {
        $data = $request->validated();
        $data['is_visible'] = $request->boolean('is_visible');

        $socialLink->update($data);

        return redirect()
            ->route('admin.social-links.index')
            ->with('success', 'Social link updated successfully.');
    }

    public function destroy(SocialLink $socialLink)
    {
        $socialLink->delete();

        return redirect()
            ->route('admin.social-links.index')
            ->with('success', 'Social link deleted successfully.');
    }
}