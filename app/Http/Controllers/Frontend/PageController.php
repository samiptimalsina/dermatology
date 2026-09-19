<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use App\Models\SiteSetting;

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
}