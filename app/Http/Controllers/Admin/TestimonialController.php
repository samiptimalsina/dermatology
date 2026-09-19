<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::ordered()->paginate(20);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.form', ['testimonial' => new Testimonial]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateTestimonial($request);

        if ($request->hasFile('patient_photo')) {
            $validated['patient_photo'] = $request->file('patient_photo')->store('testimonials', 'public');
        }

        Testimonial::create($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial created successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.form', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $validated = $this->validateTestimonial($request);

        if ($request->hasFile('patient_photo')) {
            $validated['patient_photo'] = $request->file('patient_photo')->store('testimonials', 'public');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimonial deleted.');
    }

    public function toggleActive(Testimonial $testimonial)
    {
        $testimonial->update(['is_active' => ! $testimonial->is_active]);
        return back()->with('success', 'Testimonial status updated.');
    }

    private function validateTestimonial(Request $request): array
    {
        return $request->validate([
            'patient_name'  => 'required|string|max:100',
            'treatment'     => 'nullable|string|max:100',
            'review'        => 'required|string|max:1000',
            'rating'        => 'required|integer|min:1|max:5',
            'source'        => 'required|in:google,facebook,direct',
            'patient_photo' => 'nullable|image|max:1024',
            'is_featured'   => 'boolean',
            'is_active'     => 'boolean',
            'sort_order'    => 'integer|min:0',
        ]);
    }
}
