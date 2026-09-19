<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    public function index()
    {
        $groups   = ['brand', 'general', 'hero', 'stats', 'contact', 'social', 'about', 'cta'];
        $settings = SiteSetting::all()->groupBy('group');
        return view('admin.settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'settings'   => 'required|array',
            'settings.*' => 'nullable|string',
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
            Cache::forget("setting_{$key}");
        }

        // Handle multiple logo uploads separately.
        $logoFiles = $request->file('images.site_logos', []);
        if ($logoFiles) {
            $logos = json_decode(SiteSetting::get('site_logos', '[]'), true) ?: [];
            foreach ($logoFiles as $file) {
                $logos[] = $file->store('settings/logos', 'public');
            }
            SiteSetting::set('site_logos', json_encode(array_values(array_unique($logos))));
        }

        // Handle the remaining image uploads separately.
        foreach ($request->file('images', []) as $key => $file) {
            if ($key === 'site_logos') {
                continue;
            }
            $path = $file->store('settings', 'public');
            SiteSetting::where('key', $key)->update(['value' => $path]);
            Cache::forget("setting_{$key}");
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
