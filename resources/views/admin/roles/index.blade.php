@extends('layouts.admin')
@section('title', 'Roles & Permissions')

@section('content')
<div class="space-y-6">
    @if($errors->any())
    <div class="alert-error">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <section class="bg-white border rounded-xl p-5 shadow-sm" style="border-color:var(--border)">
        <div class="mb-5">
            <h2 class="text-base font-bold" style="color:var(--dark)">Create role</h2>
            <p class="text-sm mt-1" style="color:var(--muted)">Choose the permissions this role should grant.</p>
        </div>

        <form action="{{ route('admin.roles.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="max-w-lg">
                <label class="form-label" for="new-role-name">Role name</label>
                <input class="form-input" id="new-role-name" name="name" value="{{ old('name') }}" required maxlength="125" autocomplete="off">
            </div>

            <fieldset>
                <legend class="form-label">Permissions</legend>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-5 gap-y-2">
                    @foreach($permissions as $permission)
                    <label class="inline-flex items-center gap-2 text-sm" style="color:var(--text)">
                        <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @checked(in_array($permission->id, old('permissions', []), false))>
                        {{ \Illuminate\Support\Str::headline($permission->name) }}
                    </label>
                    @endforeach
                </div>
            </fieldset>

            <button type="submit" class="btn-primary">Create role</button>
        </form>
    </section>

    <section>
        <div class="flex items-center justify-between gap-4 mb-4">
            <h2 class="text-base font-bold" style="color:var(--dark)">Available roles</h2>
            <span class="text-sm" style="color:var(--muted)">{{ $roles->total() }} roles</span>
        </div>

        <div class="grid gap-4">
            @forelse($roles as $role)
            <article class="bg-white border rounded-xl p-5 shadow-sm" style="border-color:var(--border)">
                <div class="flex flex-wrap items-start justify-between gap-3 mb-4">
                    <div>
                        <h3 class="font-bold" style="color:var(--dark)">{{ \Illuminate\Support\Str::headline($role->name) }}</h3>
                        <p class="text-xs mt-1" style="color:var(--muted)">{{ $role->users_count }} assigned users</p>
                    </div>
                    @if(in_array($role->name, $protectedRoles, true))
                    <span class="text-xs font-semibold px-2.5 py-1 rounded-full" style="background:var(--primary-light);color:var(--primary)">Seeded system role</span>
                    @endif
                </div>

                @if(in_array($role->name, $protectedRoles, true))
                <div class="flex flex-wrap gap-2">
                    @foreach($role->permissions as $permission)
                    <span class="text-xs px-2.5 py-1 rounded-md" style="background:var(--bg);color:var(--muted)">{{ \Illuminate\Support\Str::headline($permission->name) }}</span>
                    @endforeach
                </div>
                @else
                <form id="role-update-{{ $role->id }}" action="{{ route('admin.roles.update', $role) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="max-w-lg">
                        <label class="form-label" for="role-name-{{ $role->id }}">Role name</label>
                        <input class="form-input" id="role-name-{{ $role->id }}" name="name" value="{{ $role->name }}" required maxlength="125" autocomplete="off">
                    </div>

                    <fieldset>
                        <legend class="form-label">Permissions</legend>
                        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-5 gap-y-2">
                            @foreach($permissions as $permission)
                            <label class="inline-flex items-center gap-2 text-sm" style="color:var(--text)">
                                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}" @checked($role->permissions->contains('id', $permission->id))>
                                {{ \Illuminate\Support\Str::headline($permission->name) }}
                            </label>
                            @endforeach
                        </div>
                    </fieldset>
                </form>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit" form="role-update-{{ $role->id }}" class="btn-primary">Save role</button>
                    @if($role->users_count === 0)
                    <form action="{{ route('admin.roles.destroy', $role) }}" method="POST" onsubmit="return confirm('Delete this role?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline">Delete role</button>
                    </form>
                    @endif
                </div>
                @endif
            </article>
            @empty
            <div class="bg-white border rounded-xl p-8 text-center text-sm" style="border-color:var(--border);color:var(--muted)">No roles found.</div>
            @endforelse
        </div>

        <div class="mt-5">{{ $roles->links() }}</div>
    </section>
</div>
@endsection
<div>
    <!-- No surplus words or unnecessary actions. - Marcus Aurelius -->
</div>
