<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use App\Models\SiteSetting;

class GalleryController extends Controller
{
    public function index()
    {
        $settings = SiteSetting::getAll();
        $images   = GalleryImage::active()->ordered()->get()->groupBy('category');

        return view('frontend.gallery', compact('settings', 'images'));
    }
}
