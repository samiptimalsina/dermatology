<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
        $groups = ['brand', 'general', 'hero', 'stats', 'contact', 'social', 'about', 'cta'];

        foreach ([
            ['key' => 'brand_partners_eyebrow', 'value' => 'Featured brands', 'type' => 'text', 'group' => 'brand', 'label' => 'Brand Partners Eyebrow'],
            ['key' => 'brand_partners_heading', 'value' => 'Our Brand Partners', 'type' => 'text', 'group' => 'brand', 'label' => 'Brand Partners Heading'],
        ] as $setting) {
            SiteSetting::firstOrCreate(['key' => $setting['key']], $setting);
        }

        $settings = SiteSetting::all()->groupBy('group');

        return view('admin.settings.index', compact('settings', 'groups'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string',
            'images.contact_map_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'brand_partners' => ['nullable', 'array:existing,remove,uploads'],
            'brand_partners.existing' => ['nullable', 'array'],
            'brand_partners.existing.*' => ['array:name,link'],
            'brand_partners.existing.*.name' => ['nullable', 'string', 'max:120'],
            'brand_partners.existing.*.link' => ['required', 'url:http,https', 'max:2048'],
            'brand_partners.remove' => ['nullable', 'array'],
            'brand_partners.remove.*' => ['integer', 'min:0'],
            'brand_partners.uploads' => ['nullable', 'array', 'max:24'],
            'brand_partners.uploads.*' => ['array:image,name,link'],
            'brand_partners.uploads.*.image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'brand_partners.uploads.*.name' => ['nullable', 'string', 'max:120'],
            'brand_partners.uploads.*.link' => ['required', 'url:http,https', 'max:2048'],
        ]);

        foreach ($request->input('settings', []) as $key => $value) {
            if ($key === 'brand_partners') {
                continue;
            }

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
            $directory = $key === 'contact_map_image' ? 'settings/contact-map' : 'settings';
            $path = $file->store($directory, 'public');
            SiteSetting::where('key', $key)->update(['value' => $path]);
            Cache::forget("setting_{$key}");
        }

        $currentPartners = json_decode(SiteSetting::get('brand_partners', '[]'), true);
        $currentPartners = is_array($currentPartners) ? $currentPartners : [];
        $removedIndexes = array_map('intval', $validated['brand_partners']['remove'] ?? []);
        $brandPartners = [];
        $removedImages = [];

        foreach ($currentPartners as $index => $partner) {
            if (! is_array($partner) || ! filled($partner['image'] ?? null)) {
                continue;
            }

            if (in_array($index, $removedIndexes, true)) {
                $removedImages[] = $partner['image'];

                continue;
            }

            $partnerInput = $validated['brand_partners']['existing'][$index] ?? [];
            $brandPartners[] = [
                'name' => $partnerInput['name'] ?? $partner['name'] ?? '',
                'image' => $partner['image'],
                'link' => $partnerInput['link'] ?? $partner['link'] ?? '',
            ];
        }

        foreach ($validated['brand_partners']['uploads'] ?? [] as $partnerInput) {
            $file = $partnerInput['image'];
            $brandPartners[] = [
                'name' => $partnerInput['name'] ?: Str::headline(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)),
                'image' => $file->store('brand-partners', 'public'),
                'link' => $partnerInput['link'],
            ];
        }

        SiteSetting::updateOrCreate(
            ['key' => 'brand_partners'],
            [
                'value' => json_encode(array_values($brandPartners), JSON_THROW_ON_ERROR),
                'type' => 'textarea',
                'group' => 'brand',
                'label' => 'Homepage Brand Partners',
            ]
        );
        Cache::forget('setting_brand_partners');

        foreach ($removedImages as $imagePath) {
            if (Str::startsWith($imagePath, 'brand-partners/')) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings saved successfully.');
    }
}
