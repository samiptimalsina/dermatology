<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\WhyChooseUs;

class AboutController extends Controller
{
    public function index()
    {
        $seo         = SeoMeta::forPage('about');
        $settings    = SiteSetting::getAll();
        $team        = TeamMember::active()->ordered()->get();
        $whyChooseUs = WhyChooseUs::active()->ordered()->get();

        return view('frontend.about', compact('seo', 'settings', 'team', 'whyChooseUs'));
    }
}
