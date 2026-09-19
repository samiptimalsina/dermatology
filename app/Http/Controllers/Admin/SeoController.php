<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    public function index()
    {
        $pages = SeoMeta::all();
        return view('admin.seo.index', compact('pages'));
    }

    public function edit(SeoMeta $seo)
    {
        return view('admin.seo.form', compact('seo'));
    }

    public function update(Request $request, SeoMeta $seo)
    {
        $validated = $request->validate([
            'meta_title'       => 'required|string|max:200',
            'meta_description' => 'required|string|max:500',
            'content'          => 'nullable|string',
            'menu_label'       => 'nullable|string|max:100',
            'menu_icon'        => 'nullable|string|max:50',
            'meta_keywords'    => 'nullable|string|max:300',
            'og_title'         => 'nullable|string|max:200',
            'og_description'   => 'nullable|string|max:500',
            'canonical_url'    => 'nullable|url|max:300',
            'no_index'         => 'boolean',
        ]);

        if ($request->hasFile('og_image')) {
            $validated['og_image'] = $request->file('og_image')->store('seo', 'public');
        }

        $seo->update($validated);
        SeoMeta::clearCache($seo->page);

        return redirect()->route('admin.seo.index')
            ->with('success', 'SEO settings updated for ' . ucfirst($seo->page) . ' page.');
    }

    public function whyChooseUs()
    {
        $items = \App\Models\WhyChooseUs::ordered()->get();
        return view('admin.why-choose-us.index', compact('items'));
    }

    public function storeWhyChooseUs(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'icon'        => 'nullable|string|max:50',
            'sort_order'  => 'integer|min:0',
        ]);
        \App\Models\WhyChooseUs::create($validated);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item created.');
    }

    public function updateWhyChooseUs(Request $request, \App\Models\WhyChooseUs $item)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:200',
            'description' => 'required|string|max:500',
            'icon'        => 'nullable|string|max:50',
            'is_active'   => 'boolean',
            'sort_order'  => 'integer|min:0',
        ]);
        $item->update($validated);
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item updated.');
    }

    public function destroyWhyChooseUs(\App\Models\WhyChooseUs $item)
    {
        $item->delete();
        return redirect()->route('admin.why-choose-us.index')->with('success', 'Item deleted.');
    }
}
