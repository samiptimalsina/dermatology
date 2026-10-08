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
use Illuminate\Support\Str;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $seo = SeoMeta::forPage('home');
        $settings = SiteSetting::getAll();
        $partnerData = json_decode($settings->get('brand_partners', '[]'), true);
        $brandPartners = collect(is_array($partnerData) ? $partnerData : [])
            ->filter(fn (mixed $partner): bool => is_array($partner)
                && Str::startsWith($partner['image'] ?? '', 'brand-partners/')
                && filter_var($partner['link'] ?? '', FILTER_VALIDATE_URL)
                && in_array(parse_url($partner['link'], PHP_URL_SCHEME), ['http', 'https'], true))
            ->values();

        $featuredServices = Service::active()->featured()->ordered()->get();
        $doctor = TeamMember::active()->featured()->ordered()->first();
        $whyChooseUs = WhyChooseUs::active()->ordered()->get();
        $testimonials = Testimonial::active()->featured()->ordered()->get();
        $beforeAfters = BeforeAfter::active()->ordered()->take(6)->get();
        $featuredBlogs = Blog::published()->featured()->latest()->take(3)->get();

        return view('frontend.home', compact(
            'seo',
            'settings',
            'brandPartners',
            'featuredServices',
            'doctor',
            'whyChooseUs',
            'testimonials',
            'beforeAfters',
            'featuredBlogs'
        ));
    }
}
