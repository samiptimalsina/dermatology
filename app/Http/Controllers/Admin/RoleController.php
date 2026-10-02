<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    private const PROTECTED_ROLES = ['super_admin', 'blog_writer'];

    public function index(): View
    {
        return view('admin.roles.index', [
            'roles' => Role::query()
                ->with('permissions')
                ->withCount('users')
                ->where('guard_name', 'web')
                ->orderBy('name')
                ->paginate(15),
            'permissions' => Permission::query()->where('guard_name', 'web')->orderBy('name')->get(),
            'protectedRoles' => self::PROTECTED_ROLES,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->roleRules());

        DB::transaction(function () use ($validated): void {
            $role = Role::create([
                'name' => $validated['name'],
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($this->permissionsFor($validated['permissions'] ?? []));
        });

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $this->ensureWebRole($role);

        if (in_array($role->name, self::PROTECTED_ROLES, true)) {
            return back()->with('error', 'Seeded system roles cannot be changed.');
        }

        $validated = $request->validate($this->roleRules($role));

        DB::transaction(function () use ($role, $validated): void {
            $role->update(['name' => $validated['name']]);
            $role->syncPermissions($this->permissionsFor($validated['permissions'] ?? []));
        });

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        $this->ensureWebRole($role);

        if (in_array($role->name, self::PROTECTED_ROLES, true)) {
            return back()->with('error', 'Seeded system roles cannot be deleted.');
        }

        if ($role->users()->exists()) {
            return back()->with('error', 'A role assigned to users cannot be deleted.');
        }

        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }

    private function roleRules(?Role $role = null): array
    {
        $nameUniqueRule = Rule::unique('roles', 'name')
            ->where(static fn ($query) => $query->where('guard_name', 'web'));

        if ($role !== null) {
            $nameUniqueRule->ignore($role);
        }

        return [
            'name' => [
                'required',
                'string',
                'max:125',
                $nameUniqueRule,
            ],
            'permissions' => ['sometimes', 'array'],
            'permissions.*' => [
                'integer',
                Rule::exists('permissions', 'id')->where(static fn ($query) => $query->where('guard_name', 'web')),
            ],
        ];
    }

    private function permissionsFor(array $permissionIds): Collection
    {
        return Permission::query()
            ->where('guard_name', 'web')
            ->whereIn('id', $permissionIds)
            ->get();
    }

    private function ensureWebRole(Role $role): void
    {
        abort_unless($role->guard_name === 'web', 404);
    }
}
