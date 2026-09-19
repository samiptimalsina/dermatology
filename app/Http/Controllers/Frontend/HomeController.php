<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\BeforeAfter;
use App\Models\Blog;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\SiteSetting;
use App\Models\TeamMember;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;

class HomeController extends Controller
{
    public function index()
    {
        $seo      = SeoMeta::forPage('home');
        $settings = SiteSetting::getAll();

        $featuredServices  = Service::active()->featured()->ordered()->get();
        $doctor            = TeamMember::active()->featured()->ordered()->first();
        $whyChooseUs       = WhyChooseUs::active()->ordered()->get();
        $testimonials      = Testimonial::active()->featured()->ordered()->get();
        $beforeAfters      = BeforeAfter::active()->ordered()->take(6)->get();
        $featuredBlogs     = Blog::published()->featured()->latest()->take(3)->get();

        return view('frontend.home', compact(
            'seo',
            'settings',
            'featuredServices',
            'doctor',
            'whyChooseUs',
            'testimonials',
            'beforeAfters',
            'featuredBlogs'
        ));
    }
}
