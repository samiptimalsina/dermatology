@extends('layouts.admin')
@section('title', 'Users')

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
            <h2 class="text-base font-bold" style="color:var(--dark)">Add user</h2>
            <p class="text-sm mt-1" style="color:var(--muted)">Create an account and choose the roles it should receive.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="new-user-name">Name</label>
                    <input class="form-input" id="new-user-name" name="name" value="{{ old('name') }}" required maxlength="255" autocomplete="name">
                </div>
                <div>
                    <label class="form-label" for="new-user-email">Email</label>
                    <input class="form-input" id="new-user-email" type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
                </div>
                <div>
                    <label class="form-label" for="new-user-password">Password</label>
                    <input class="form-input" id="new-user-password" type="password" name="password" required minlength="12" autocomplete="new-password">
                </div>
                <div>
                    <label class="form-label" for="new-user-password-confirmation">Confirm password</label>
                    <input class="form-input" id="new-user-password-confirmation" type="password" name="password_confirmation" required minlength="12" autocomplete="new-password">
                </div>
            </div>

            <fieldset>
                <legend class="form-label">Roles</legend>
                <div class="flex flex-wrap gap-x-5 gap-y-2">
                    @foreach($roles as $role)
                    <label class="inline-flex items-center gap-2 text-sm" style="color:var(--text)">
                        <input type="checkbox" name="roles[]" value="{{ $role->name }}" @checked(in_array($role->name, old('roles', []), true))>
                        {{ \Illuminate\Support\Str::headline($role->name) }}
                    </label>
                    @endforeach
                </div>
            </fieldset>

            <button type="submit" class="btn-primary">Create user</button>
        </form>
    </section>

    <section>
        <div class="flex items-center justify-between gap-4 mb-4">
            <h2 class="text-base font-bold" style="color:var(--dark)">User accounts</h2>
            <span class="text-sm" style="color:var(--muted)">{{ $users->total() }} users</span>
        </div>

        <div class="grid gap-4">
            @forelse($users as $user)
            <article class="bg-white border rounded-xl p-5 shadow-sm" style="border-color:var(--border)">
                <form id="user-update-{{ $user->id }}" action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="form-label" for="user-name-{{ $user->id }}">Name</label>
                            <input class="form-input" id="user-name-{{ $user->id }}" name="name" value="{{ $user->name }}" required maxlength="255" autocomplete="name">
                        </div>
                        <div>
                            <label class="form-label" for="user-email-{{ $user->id }}">Email</label>
                            <input class="form-input" id="user-email-{{ $user->id }}" type="email" name="email" value="{{ $user->email }}" required maxlength="255" autocomplete="email">
                        </div>
                        <div>
                            <label class="form-label" for="user-password-{{ $user->id }}">New password <span class="font-normal" style="color:var(--muted)">(leave blank to keep current)</span></label>
                            <input class="form-input" id="user-password-{{ $user->id }}" type="password" name="password" minlength="12" autocomplete="new-password">
                        </div>
                        <div>
                            <label class="form-label" for="user-password-confirmation-{{ $user->id }}">Confirm new password</label>
                            <input class="form-input" id="user-password-confirmation-{{ $user->id }}" type="password" name="password_confirmation" minlength="12" autocomplete="new-password">
                        </div>
                    </div>

                    <fieldset>
                        <legend class="form-label">Roles</legend>
                        <div class="flex flex-wrap gap-x-5 gap-y-2">
                            @foreach($roles as $role)
                            <label class="inline-flex items-center gap-2 text-sm" style="color:var(--text)">
                                <input type="checkbox" name="roles[]" value="{{ $role->name }}" @checked($user->roles->contains('name', $role->name))>
                                {{ \Illuminate\Support\Str::headline($role->name) }}
                            </label>
                            @endforeach
                        </div>
                    </fieldset>

                </form>

                <div class="flex flex-wrap items-center gap-3">
                    <button type="submit" form="user-update-{{ $user->id }}" class="btn-primary">Save user</button>
                    @if(auth()->id() !== $user->id)
                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user account?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-outline">Delete user</button>
                    </form>
                    @endif
                </div>
            </article>
            @empty
            <div class="bg-white border rounded-xl p-8 text-center text-sm" style="border-color:var(--border);color:var(--muted)">No user accounts found.</div>
            @endforelse
        </div>

        <div class="mt-5">{{ $users->links() }}</div>
    </section>
</div>
@endsection
<div>
    <!-- Nothing in life is to be feared, it is only to be understood. Now is the time to understand more, so that we may fear less. - Maria Skłodowska-Curie -->
</div>
