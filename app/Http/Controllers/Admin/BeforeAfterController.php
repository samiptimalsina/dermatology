<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BeforeAfter;
use Illuminate\Http\Request;

class BeforeAfterController extends Controller
{
    public function index()
    {
        $items = BeforeAfter::ordered()->paginate(20);
        return view('admin.before-afters.index', compact('items'));
    }

    public function create()
    {
        return view('admin.before-afters.form', ['item' => new BeforeAfter]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateItem($request);

        $validated['before_image'] = $request->file('before_image')->store('before-after', 'public');
        $validated['after_image']  = $request->file('after_image')->store('before-after', 'public');

        BeforeAfter::create($validated);

        return redirect()->route('admin.before-afters.index')
            ->with('success', 'Before/After created successfully.');
    }

    public function edit(BeforeAfter $beforeAfter)
    {
        return view('admin.before-afters.form', ['item' => $beforeAfter]);
    }

    public function update(Request $request, BeforeAfter $beforeAfter)
    {
        $validated = $this->validateItem($request, editing: true);

        if ($request->hasFile('before_image')) {
            $validated['before_image'] = $request->file('before_image')->store('before-after', 'public');
        }
        if ($request->hasFile('after_image')) {
            $validated['after_image'] = $request->file('after_image')->store('before-after', 'public');
        }

        $beforeAfter->update($validated);

        return redirect()->route('admin.before-afters.index')
            ->with('success', 'Before/After updated successfully.');
    }

    public function destroy(BeforeAfter $beforeAfter)
    {
        $beforeAfter->delete();
        return redirect()->route('admin.before-afters.index')
            ->with('success', 'Item deleted.');
    }

    private function validateItem(Request $request, bool $editing = false): array
    {
        return $request->validate([
            'title'        => 'required|string|max:200',
            'treatment'    => 'required|string|max:200',
            'description'  => 'nullable|string|max:500',
            'before_image' => ($editing ? 'nullable' : 'required') . '|image|max:3072',
            'after_image'  => ($editing ? 'nullable' : 'required') . '|image|max:3072',
            'is_active'    => 'boolean',
            'sort_order'   => 'integer|min:0',
        ]);
    }
}
