<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    public function index()
    {
        $members = TeamMember::ordered()->paginate(20);
        return view('admin.team.index', compact('members'));
    }

    public function create()
    {
        return view('admin.team.form', ['member' => new TeamMember]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        TeamMember::create($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member created successfully.');
    }

    public function edit(TeamMember $team)
    {
        return view('admin.team.form', ['member' => $team]);
    }

    public function update(Request $request, TeamMember $team)
    {
        $validated = $this->validateMember($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $request->file('photo')->store('team', 'public');
        }

        $team->update($validated);

        return redirect()->route('admin.team.index')
            ->with('success', 'Team member updated successfully.');
    }

    public function destroy(TeamMember $team)
    {
        $team->delete();
        return redirect()->route('admin.team.index')
            ->with('success', 'Team member deleted.');
    }

    private function validateMember(Request $request): array
    {
        return $request->validate([
            'name'             => 'required|string|max:100',
            'designation'      => 'required|string|max:100',
            'qualification'    => 'nullable|string|max:200',
            'specialization'   => 'nullable|string|max:200',
            'bio'              => 'required|string',
            'years_experience' => 'integer|min:0',
            'total_patients'   => 'integer|min:0',
            'photo'            => 'nullable|image|max:2048',
            'is_featured'      => 'boolean',
            'is_active'        => 'boolean',
            'sort_order'       => 'integer|min:0',
        ]);
    }
}
