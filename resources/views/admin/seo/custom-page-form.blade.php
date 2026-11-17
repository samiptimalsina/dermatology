@extends('layouts.admin')
@section('title', $customPage->exists ? 'Edit Custom Page' : 'Create Custom Page')
@section('content')
<div class="w-full">
    <a href="{{ route('admin.seo.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back to SEO</a>
    @if($errors->any())
    <div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif

    <form action="{{ $customPage->exists ? route('admin.seo.custom-pages.update', $customPage) : route('admin.seo.custom-pages.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf
        @if($customPage->exists) @method('PUT') @endif

        <div>
            <label class="form-label">Page Title <span style="color:#EF4444">*</span></label>
            <input type="text" name="title" value="{{ old('title', $customPage->title) }}" class="form-input" maxlength="255" required>
        </div>
        <div>
            <label class="form-label">Page Slug <span style="color:#EF4444">*</span></label>
            <div class="flex items-center gap-2">
                <span class="text-sm whitespace-nowrap" style="color:var(--muted)">{{ url('/') }}/</span>
                <input type="text" name="slug" value="{{ old('slug', $customPage->slug) }}" class="form-input" maxlength="255" pattern="[a-z0-9]+(-[a-z0-9]+)*" onblur="this.value = this.value.trim()" required>
            </div>
            <p class="text-xs mt-1" style="color:var(--muted)">Lowercase letters, numbers, and hyphens only. Spaces at the start or end are trimmed when saved.</p>
        </div>
        <div>
            <label class="form-label">Page Content <span style="color:#EF4444">*</span></label>
            <textarea name="content" rows="12" class="form-input rich-editor resize-y">{{ old('content', $customPage->content) }}</textarea>
        </div>
        <div>
            <label class="form-label">Meta Title</label>
            <input type="text" name="meta_title" value="{{ old('meta_title', $customPage->meta_title) }}" class="form-input" maxlength="200">
        </div>
        <div>
            <label class="form-label">Meta Description</label>
            <textarea name="meta_description" rows="3" class="form-input resize-none" maxlength="500">{{ old('meta_description', $customPage->meta_description) }}</textarea>
        </div>
        <div>
            <label class="form-label" for="menu-icon-search">Frontend Menu Icon</label>
            <input type="hidden" name="menu_icon" id="menu-icon-value" value="{{ old('menu_icon', $customPage->menu_icon ?? 'document') }}" required>
            <div class="relative" data-icon-picker>
                <button type="button" class="form-input flex w-full items-center justify-between gap-3 text-left" data-icon-picker-toggle aria-expanded="false" aria-controls="menu-icon-options">
                    <span class="flex items-center gap-2" data-icon-picker-selected>
                        @include('frontend.partials.menu-icon', ['icon' => old('menu_icon', $customPage->menu_icon ?? 'document')])
                        <span>{{ \App\Models\CustomPage::menuIconOptions()[old('menu_icon', $customPage->menu_icon ?? 'document')] ?? 'Document' }}</span>
                    </span>
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6 9 6 6 6-6"/>
                    </svg>
                </button>
                <div id="menu-icon-options" class="absolute z-30 mt-2 hidden w-full rounded-xl border bg-white p-3 shadow-xl" style="border-color:var(--border)" data-icon-picker-panel>
                    <input type="search" id="menu-icon-search" class="form-input mb-3" placeholder="Search over 200 icons..." autocomplete="off" data-icon-picker-search>
                    <div class="grid max-h-72 grid-cols-2 gap-2 overflow-y-auto sm:grid-cols-3" role="listbox" aria-label="Menu icons" data-icon-picker-options>
                        @foreach(\App\Models\CustomPage::menuIconOptions() as $icon => $label)
                        <button type="button" class="flex min-w-0 items-center gap-2 rounded-lg border p-2 text-left text-sm hover:bg-gray-50" style="border-color:var(--border);color:var(--text)" role="option" aria-selected="{{ old('menu_icon', $customPage->menu_icon ?? 'document') === $icon ? 'true' : 'false' }}" data-icon-option data-icon-value="{{ $icon }}" data-icon-name="{{ strtolower($label) }}" data-icon-label="{{ $label }}">
                            @include('frontend.partials.menu-icon', ['icon' => $icon])
                            <span class="truncate">{{ $label }}</span>
                        </button>
                        @endforeach
                    </div>
                    <p class="hidden py-4 text-center text-sm" style="color:var(--muted)" data-icon-picker-empty>No icons match your search.</p>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap gap-6">
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="is_published" value="0">
                <input type="checkbox" name="is_published" value="1" {{ old('is_published', $customPage->is_published ?? true) ? 'checked' : '' }}>
                Published
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="no_index" value="0">
                <input type="checkbox" name="no_index" value="1" {{ old('no_index', $customPage->no_index) ? 'checked' : '' }}>
                Hide from search engines
            </label>
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:var(--text)">
                <input type="hidden" name="show_on_menu" value="0">
                <input type="checkbox" name="show_on_menu" value="1" {{ old('show_on_menu', $customPage->show_on_menu) ? 'checked' : '' }}>
                Show on menu
            </label>
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="btn-primary">{{ $customPage->exists ? 'Update Custom Page' : 'Create Custom Page' }}</button>
            <a href="{{ route('admin.seo.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
@push('scripts')
<script>
document.querySelectorAll('[data-icon-picker]').forEach((picker) => {
    const toggle = picker.querySelector('[data-icon-picker-toggle]');
    const panel = picker.querySelector('[data-icon-picker-panel]');
    const search = picker.querySelector('[data-icon-picker-search]');
    const value = document.getElementById('menu-icon-value');
    const selected = picker.querySelector('[data-icon-picker-selected]');
    const options = [...picker.querySelectorAll('[data-icon-option]')];
    const empty = picker.querySelector('[data-icon-picker-empty]');

    toggle.addEventListener('click', () => {
        const isOpen = panel.classList.toggle('hidden') === false;
        toggle.setAttribute('aria-expanded', String(isOpen));
        if (isOpen) {
            search.focus();
        }
    });

    search.addEventListener('input', () => {
        const query = search.value.trim().toLowerCase();
        let visibleOptions = 0;

        options.forEach((option) => {
            const matches = option.dataset.iconName.includes(query);
            option.classList.toggle('hidden', !matches);
            visibleOptions += matches ? 1 : 0;
        });

        empty.classList.toggle('hidden', visibleOptions > 0);
    });

    options.forEach((option) => {
        option.addEventListener('click', () => {
            value.value = option.dataset.iconValue;
            selected.replaceChildren(
                option.querySelector('[data-menu-icon]').cloneNode(true),
                Object.assign(document.createElement('span'), { textContent: option.dataset.iconLabel })
            );
            options.forEach((item) => item.setAttribute('aria-selected', String(item === option)));
            panel.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
            search.value = '';
            options.forEach((item) => item.classList.remove('hidden'));
            empty.classList.add('hidden');
        });
    });

    document.addEventListener('click', (event) => {
        if (!picker.contains(event.target)) {
            panel.classList.add('hidden');
            toggle.setAttribute('aria-expanded', 'false');
        }
    });
});
</script>
@endpush