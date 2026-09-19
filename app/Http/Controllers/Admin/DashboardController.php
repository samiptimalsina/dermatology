<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\Blog;
use App\Models\Service;
use App\Models\Testimonial;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_appointments'   => Appointment::count(),
            'pending_appointments' => Appointment::pending()->count(),
            'total_services'       => Service::count(),
            'active_services'      => Service::active()->count(),
            'total_blogs'          => Blog::count(),
            'published_blogs'      => Blog::published()->count(),
            'total_testimonials'   => Testimonial::count(),
        ];

        $recentAppointments = Appointment::latest()->take(5)->get();
        $recentBlogs        = Blog::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentAppointments', 'recentBlogs'));
    }
}
