<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CustomPage;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show(string $page)
    {
        abort_unless(in_array($page, ['privacy-policy', 'terms-and-conditions'], true), 404);

        $seo = SeoMeta::forPage(str_replace('-', '_', $page));
        abort_unless($seo, 404);

        $settings = SiteSetting::getAll();

        return view('frontend.policy-page', compact('seo', 'settings'));
    }

    public function showCustom(CustomPage $customPage): View
    {
        abort_unless($customPage->is_published, 404);

        $seo = $customPage;

        return view('frontend.custom-page', compact('customPage', 'seo'));
    }
}
