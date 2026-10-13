<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use App\Models\WhyChooseUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SeoController extends Controller
{
    private const ABOUT_SETTING_KEYS = [
        'doctor_name',
        'doctor_title',
        'doctor_bio',
        'doctor_photo',
        'about_clinic_image',
        'stat_years',
        'stat_patients',
    ];

    private const CONTACT_SETTING_KEYS = [
        'contact_phone',
        'contact_phone2',
        'contact_email',
        'contact_address',
        'contact_hours',
        'google_maps_embed',
        'contact_map_image',
    ];

    public function index()
    {
        $pages = SeoMeta::all();
        $customPages = CustomPage::query()->orderBy('title')->get();

        return view('admin.seo.index', compact('pages', 'customPages'));
    }

    public function edit(SeoMeta $seo)
    {
        $aboutSettings = $seo->page === 'about'
            ? SiteSetting::whereIn('key', self::ABOUT_SETTING_KEYS)->get()->keyBy('key')
            : collect();
        $contactSettings = $seo->page === 'contact'
            ? SiteSetting::whereIn('key', self::CONTACT_SETTING_KEYS)->get()->keyBy('key')
            : collect();

        return view('admin.seo.form', compact('seo', 'aboutSettings', 'contactSettings'));
    }

    public function update(Request $request, SeoMeta $seo)
    {
        $request->merge(['slug' => trim((string) $request->input('slug'))]);

        $rules = [
            'slug' => 'required|string|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:seo_meta,slug,'.$seo->id,
            'meta_title' => 'required|string|max:200',
            'meta_description' => 'required|string|max:500',
            'content' => 'nullable|string',
            'menu_label' => 'nullable|string|max:100',
            'menu_icon' => 'nullable|string|max:50',
            'meta_keywords' => 'nullable|string|max:300',
            'og_title' => 'nullable|string|max:200',
            'og_description' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|url|max:300',
            'no_index' => 'boolean',
        ];

        if ($seo->page === 'about') {
            $rules += [
                'about_settings' => 'sometimes|array:doctor_name,doctor_title,doctor_bio,stat_years,stat_patients',
                'about_settings.doctor_name' => 'nullable|string|max:255',
                'about_settings.doctor_title' => 'nullable|string|max:255',
                'about_settings.doctor_bio' => 'nullable|string|max:10000',
                'about_settings.stat_years' => 'nullable|string|max:50',
                'about_settings.stat_patients' => 'nullable|string|max:50',
                'about_images' => 'sometimes|array:doctor_photo,about_clinic_image',
                'about_images.doctor_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
                'about_images.about_clinic_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ];
        }

        if ($seo->page === 'contact') {
            $rules += [
                'contact_settings' => 'sometimes|array:contact_phone,contact_phone2,contact_email,contact_address,contact_hours,google_maps_embed',
                'contact_settings.contact_phone' => 'nullable|string|max:50',
                'contact_settings.contact_phone2' => 'nullable|string|max:50',
                'contact_settings.contact_email' => 'nullable|email|max:255',
                'contact_settings.contact_address' => 'nullable|string|max:1000',
                'contact_settings.contact_hours' => 'nullable|string|max:255',
                'contact_settings.google_maps_embed' => 'nullable|url:http,https|max:2048',
                'contact_images' => 'sometimes|array:contact_map_image',
                'contact_images.contact_map_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            ];
        }

        $validated = $request->validate($rules);
        $pageSettings = $validated['about_settings'] ?? [];
        $pageImages = $request->file('about_images', []);

        if ($seo->page === 'contact') {
            $pageSettings = $validated['contact_settings'] ?? [];
            $pageImages = $request->file('contact_images', []);
        }

        unset($validated['about_settings'], $validated['about_images'], $validated['contact_settings'], $validated['contact_images']);

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $seo->update($validated);

        foreach ($pageSettings as $key => $value) {
            SiteSetting::where('key', $key)->update(['value' => $value]);
            Cache::forget("setting_{$key}");
        }

        foreach ($pageImages as $key => $file) {
            $directory = $key === 'contact_map_image' ? 'settings/contact-map' : 'settings';
            $path = $file->store($directory, 'public');
            SiteSetting::where('key', $key)->update(['value' => $path]);
            Cache::forget("setting_{$key}");
        }

        SeoMeta::clearCache($seo->page);

        return redirect()->route('admin.seo.index')
            ->with('success', 'SEO settings updated for '.ucfirst($seo->page).' page.');
    }

    public function whyChooseUs()
    {
        $items = WhyChooseUs::ordered()->get();

        return view('admin.why-choose-us.index', compact('items'));
    }

    public function storeWhyChooseUs(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'icon' => 'nullable|string|max:50',
            'sort_order' => 'integer|min:0',
        ]);
        WhyChooseUs::create($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item created.');
    }

    public function updateWhyChooseUs(Request $request, WhyChooseUs $item)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'icon' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ]);
        $item->update($validated);

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item updated.');
    }

    public function destroyWhyChooseUs(WhyChooseUs $item)
    {
        $item->delete();

        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item deleted.');
    }
}
