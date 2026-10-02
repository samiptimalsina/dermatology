<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomPageController extends Controller
{
    public function create(): View
    {
        return view('admin.seo.custom-page-form', ['customPage' => new CustomPage]);
    }

    public function store(Request $request): RedirectResponse
    {
        CustomPage::create($this->validatedPage($request));

        return Redirect::route('admin.seo.index')->with('success', 'Custom page created.');
    }

    public function edit(CustomPage $customPage): View
    {
        return view('admin.seo.custom-page-form', compact('customPage'));
    }

    public function update(Request $request, CustomPage $customPage): RedirectResponse
    {
        $customPage->update($this->validatedPage($request, $customPage));

        return Redirect::route('admin.seo.index')->with('success', 'Custom page updated.');
    }

    public function destroy(CustomPage $customPage): RedirectResponse
    {
        $customPage->delete();

        return Redirect::route('admin.seo.index')->with('success', 'Custom page deleted.');
    }

    private function validatedPage(Request $request, ?CustomPage $customPage = null): array
    {
        $request->merge(['slug' => trim((string) $request->input('slug'))]);

        $slugRules = [
            'required',
            'string',
            'max:255',
            'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            Rule::notIn([
                'admin',
                'about',
                'our-services',
                'services',
                'blog',
                'videos',
                'privacy-policy',
                'terms-and-conditions',
                'gallery',
                'contact',
            ]),
        ];

        $slugRules[] = $customPage
            ? Rule::unique('custom_pages', 'slug')->ignore($customPage->id)
            : Rule::unique('custom_pages', 'slug');

        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => $slugRules,
            'content' => ['required', 'string'],
            'meta_title' => ['nullable', 'string', 'max:200'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'no_index' => ['boolean'],
            'is_published' => ['boolean'],
        ]);
    }
}
