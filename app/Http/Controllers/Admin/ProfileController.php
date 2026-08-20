<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {
        $profile = Profile::firstOrNew();

        return view('admin.profile.edit', compact('profile'));
    }

    public function update(ProfileRequest $request)
    {
        $profile = Profile::firstOrNew();
        $data = $request->validated();

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profile', 'public');

            if ($profile->profile_image && $profile->profile_image !== $path) {
                Storage::disk('public')->delete($profile->profile_image);
            }

            $data['profile_image'] = $path;
        }

        if ($request->hasFile('cv_file')) {
            $path = $request->file('cv_file')->store('cv', 'public');

            if ($profile->cv_file && $profile->cv_file !== $path) {
                Storage::disk('public')->delete($profile->cv_file);
            }

            $data['cv_file'] = $path;
        }

        $profile->fill($data)->save();

        return redirect()
            ->route('admin.profile.edit')
            ->with('success', 'Profile updated successfully.');
    }
}