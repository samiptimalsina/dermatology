<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\SeoMeta;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $seo      = SeoMeta::forPage('contact');
        $settings = SiteSetting::getAll();
        $services = Service::active()->ordered()->pluck('title', 'id');

        return view('frontend.contact', compact('seo', 'settings', 'services'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:100',
            'phone'          => 'required|string|max:20',
            'email'          => 'nullable|email|max:100',
            'service'        => 'nullable|string|max:100',
            'preferred_date' => 'nullable|date|after_or_equal:today',
            'preferred_time' => 'nullable|string|max:20',
            'message'        => 'nullable|string|max:1000',
        ]);

        Appointment::create($validated);

        return redirect()->route('contact')
            ->with('success', 'Your appointment request has been submitted! We will contact you within 24 hours to confirm.');
    }
}
