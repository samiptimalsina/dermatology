<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\SiteSetting;

class ServiceController extends Controller
{
    public function index()
    {
        $seo      = SeoMeta::forPage('services');
        $settings = SiteSetting::getAll();

        $services = Service::active()->ordered()->get()->groupBy('category');

        return view('frontend.services', compact('seo', 'settings', 'services'));
    }

    public function show(Service $service)
    {
        abort_if(! $service->is_active, 404);

        $settings        = SiteSetting::getAll();
        $relatedServices = Service::active()
            ->where('category', $service->category)
            ->where('id', '!=', $service->id)
            ->ordered()
            ->take(3)
            ->get();

        return view('frontend.service-detail', compact('service', 'settings', 'relatedServices'));
    }
}
