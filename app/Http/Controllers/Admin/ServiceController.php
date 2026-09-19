<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax() || $request->has('draw')) {
            return DataTables::eloquent(Service::query()->ordered())
                ->addColumn('image', fn (Service $service) => '<img src="'.e($service->image_url).'" alt="" class="w-12 h-12 rounded-lg object-cover">')
                ->editColumn('title', fn (Service $service) => e($service->title))
                ->editColumn('category', fn (Service $service) => '<span class="badge badge-gray">'.e(ucfirst($service->category)).'</span>')
                ->editColumn('is_featured', fn (Service $service) => $service->is_featured
                    ? '<span class="badge badge-yellow">Featured</span>'
                    : '<span style="color:var(--muted)">—</span>')
                ->editColumn('is_active', function (Service $service) {
                    return view('admin.services.partials.status', compact('service'))->render();
                })
                ->addColumn('actions', function (Service $service) {
                    return view('admin.services.partials.actions', compact('service'))->render();
                })
                ->rawColumns(['image', 'category', 'is_featured', 'is_active', 'actions'])
                ->toJson();
        }

        return view('admin.services.index', ['totalServices' => Service::count()]);
    }

    public function create()
    {
        return view('admin.services.form', ['service' => new Service]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateService($request);
        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        Service::create($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.form', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $this->validateService($request, $service->id);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('services', 'public');
        }

        $service->update($validated);

        return redirect()->route('admin.services.index')
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')
            ->with('success', 'Service deleted.');
    }

    public function toggleActive(Service $service)
    {
        $service->update(['is_active' => ! $service->is_active]);
        return back()->with('success', 'Service status updated.');
    }

    private function validateService(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'title'             => 'required|string|max:200',
            'category'          => 'required|in:skin,hair,laser,surgical,general',
            'short_description' => 'required|string|max:500',
            'full_description'  => 'nullable|string',
            'icon'              => 'nullable|string|max:50',
            'image'             => 'nullable|image|max:2048',
            'meta_title'        => 'nullable|string|max:200',
            'meta_description'  => 'nullable|string|max:500',
            'is_featured'       => 'boolean',
            'is_active'         => 'boolean',
            'sort_order'        => 'integer|min:0',
        ]);
    }
}
