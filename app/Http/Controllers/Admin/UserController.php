<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(): View
    {
        return view('admin.users.index', [
            'users' => User::query()->with('roles')->orderBy('name')->paginate(15),
            'roles' => Role::query()->where('guard_name', 'web')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->userRules());

        DB::transaction(function () use ($validated): void {
            $user = User::create(Arr::only($validated, ['name', 'email', 'password']));
            $user->syncRoles($validated['roles']);
        });

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $validated = $request->validate($this->userRules($user));
        $roleNames = $validated['roles'];

        if ($this->wouldRemoveFinalSuperAdmin($user, $roleNames)) {
            return back()->withErrors(['roles' => 'At least one super admin account must remain.'])->withInput();
        }

        DB::transaction(function () use ($validated, $roleNames, $user): void {
            $attributes = Arr::only($validated, ['name', 'email']);

            if (filled($validated['password'] ?? null)) {
                $attributes['password'] = $validated['password'];
            }

            $user->update($attributes);
            $user->syncRoles($roleNames);
        });

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->is($user)) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        if ($user->hasRole('super_admin') && User::role('super_admin')->count() <= 1) {
            return back()->with('error', 'At least one super admin account must remain.');
        }

        DB::transaction(function () use ($user): void {
            $user->syncRoles([]);
            $user->syncPermissions([]);
            $user->delete();
        });

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }

    private function userRules(?User $user = null): array
    {
        $emailUniqueRule = Rule::unique('users', 'email');

        if ($user !== null) {
            $emailUniqueRule->ignore($user);
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', $emailUniqueRule],
            'password' => $user === null
                ? ['required', 'string', 'min:12', 'confirmed']
                : ['nullable', 'string', 'min:12', 'confirmed'],
            'roles' => ['required', 'array', 'min:1'],
            'roles.*' => [
                'required',
                'string',
                Rule::exists('roles', 'name')->where(static fn ($query) => $query->where('guard_name', 'web')),
            ],
        ];
    }

    private function wouldRemoveFinalSuperAdmin(User $user, array $roleNames): bool
    {
        return $user->hasRole('super_admin')
            && ! in_array('super_admin', $roleNames, true)
            && User::role('super_admin')->count() <= 1;
    }
}
