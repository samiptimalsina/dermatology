@extends('layouts.admin')
@section('title', 'Users')

@section('content')
<div class="space-y-5">
    @if($errors->any())
    <div class="alert-error">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="flex flex-wrap items-center justify-between gap-3">
        <p class="text-sm" style="color:var(--muted)">{{ $totalUsers }} accounts</p>
        <button type="button" class="btn-primary" id="create-user-button">+ Create user</button>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-x-auto">
        <table id="users-table" class="admin-table w-full" data-server-side="true">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Roles</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<div id="user-modal" class="fixed inset-0 hidden items-center justify-center p-4" style="z-index:120;background:rgba(0,25,22,.58)" role="presentation">
    <section class="bg-white w-full max-w-2xl max-h-[90vh] overflow-y-auto rounded-xl shadow-lg" role="dialog" aria-modal="true" aria-labelledby="user-modal-title">
        <div class="flex items-center justify-between gap-4 p-5 border-b" style="border-color:var(--border)">
            <h2 id="user-modal-title" class="text-lg font-bold" style="color:var(--dark)">Create user</h2>
            <button type="button" id="close-user-modal" class="mobile-header-btn" aria-label="Close user form" style="background:var(--primary-light);color:var(--primary)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <form id="user-form" action="{{ route('admin.users.store') }}" method="POST" class="p-5 space-y-5">
            @csrf
            <input type="hidden" id="user-form-method" name="_method" value="PUT" disabled>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="form-label" for="user-name">Name</label>
                    <input class="form-input" id="user-name" name="name" value="{{ old('name') }}" required maxlength="255" autocomplete="name">
                </div>
                <div>
                    <label class="form-label" for="user-email">Email</label>
                    <input class="form-input" id="user-email" type="email" name="email" value="{{ old('email') }}" required maxlength="255" autocomplete="email">
                </div>
                <div>
                    <label class="form-label" for="user-password">Password</label>
                    <input class="form-input" id="user-password" type="password" name="password" required minlength="12" autocomplete="new-password">
                </div>
                <div>
                    <label class="form-label" for="user-password-confirmation">Confirm password</label>
                    <input class="form-input" id="user-password-confirmation" type="password" name="password_confirmation" required minlength="12" autocomplete="new-password">
                </div>
            </div>

            <fieldset>
                <legend class="form-label">Roles</legend>
                <div class="flex flex-wrap gap-2">
                    @foreach($roles as $role)
                    <label class="inline-flex min-h-10 cursor-pointer items-center gap-2 rounded-lg border px-3 py-2 text-sm transition-colors hover:bg-[#F2FBFA] has-[:checked]:border-primary has-[:checked]:bg-[#E8F7F5]" style="border-color:var(--border);color:var(--text)">
                        <input type="checkbox" class="accent-primary focus-visible:ring-2 focus-visible:ring-primary" name="roles[]" value="{{ $role->name }}" data-user-role @checked(in_array($role->name, old('roles', []), true))>
                        {{ \Illuminate\Support\Str::headline($role->name) }}
                    </label>
                    @endforeach
                </div>
            </fieldset>

            <div class="flex justify-end gap-3 pt-2">
                <button type="button" id="cancel-user-modal" class="btn-outline">Cancel</button>
                <button type="submit" class="btn-primary" id="save-user-button">Create user</button>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const table = Array.from(document.querySelectorAll('#users-table')).find(function (element) {
            return element.getClientRects().length > 0;
        });

        if (!table) return;

        if (!DataTable.isDataTable(table)) {
            new DataTable(table, {
                processing: true,
                serverSide: true,
                ajax: @json(route('admin.users.index')),
                pageLength: 15,
                lengthMenu: [10, 15, 25, 50],
                order: [[0, 'asc']],
                columns: [
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'roles', name: 'roles', orderable: false, searchable: false },
                    { data: 'created_at', name: 'created_at' },
                    { data: 'actions', name: 'actions', orderable: false, searchable: false }
                ]
            });
        }

        const modal = document.getElementById('user-modal');
        const form = document.getElementById('user-form');
        const methodInput = document.getElementById('user-form-method');
        const title = document.getElementById('user-modal-title');
        const saveButton = document.getElementById('save-user-button');
        const password = document.getElementById('user-password');
        const passwordConfirmation = document.getElementById('user-password-confirmation');
        const updateUrlTemplate = @json(route('admin.users.update', ['user' => '__USER_ID__']));

        function closeModal() {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = '';
        }

        function openCreateModal() {
            form.reset();
            form.action = @json(route('admin.users.store'));
            methodInput.disabled = true;
            title.textContent = 'Create user';
            saveButton.textContent = 'Create user';
            password.required = true;
            passwordConfirmation.required = true;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            document.getElementById('user-name').focus();
        }

        document.getElementById('create-user-button').addEventListener('click', openCreateModal);
        document.getElementById('close-user-modal').addEventListener('click', closeModal);
        document.getElementById('cancel-user-modal').addEventListener('click', closeModal);
        modal.addEventListener('click', function (event) {
            if (event.target === modal) closeModal();
        });

        table.addEventListener('click', function (event) {
            const editButton = event.target.closest('[data-user-edit]');

            if (!editButton) return;

            form.reset();
            form.action = updateUrlTemplate.replace('__USER_ID__', encodeURIComponent(editButton.dataset.userId));
            methodInput.disabled = false;
            title.textContent = 'Edit user';
            saveButton.textContent = 'Save changes';
            document.getElementById('user-name').value = editButton.dataset.userName;
            document.getElementById('user-email').value = editButton.dataset.userEmail;
            password.required = false;
            passwordConfirmation.required = false;

            const selectedRoles = JSON.parse(editButton.dataset.userRoles || '[]');
            form.querySelectorAll('[data-user-role]').forEach(function (checkbox) {
                checkbox.checked = selectedRoles.includes(checkbox.value);
            });

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
            document.getElementById('user-name').focus();
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) closeModal();
        });
    });

    document.addEventListener('admin:content-synced', function () {
        if (window.innerWidth < 1024) document.dispatchEvent(new Event('DOMContentLoaded'));
    });
</script>
@endpush
