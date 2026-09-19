<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryImage;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = GalleryImage::ordered()->paginate(20);
        return view('admin.gallery.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'      => 'required|array',
            'images.*'    => 'image|max:3072',
            'category'    => 'required|in:clinic,treatment,team,events',
            'title'       => 'nullable|string|max:200',
            'description' => 'nullable|string|max:500',
        ]);

        foreach ($request->file('images') as $file) {
            GalleryImage::create([
                'title'       => $request->title,
                'image'       => $file->store('gallery', 'public'),
                'category'    => $request->category,
                'description' => $request->description,
                'is_active'   => true,
            ]);
        }

        return redirect()->route('admin.gallery.index')
            ->with('success', count($request->file('images')) . ' image(s) uploaded successfully.');
    }

    public function destroy(GalleryImage $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')
            ->with('success', 'Image deleted.');
    }

    public function toggleActive(GalleryImage $gallery)
    {
        $gallery->update(['is_active' => ! $gallery->is_active]);
        return back()->with('success', 'Image status updated.');
    }
}
