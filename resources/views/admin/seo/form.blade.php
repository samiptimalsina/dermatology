@extends('layouts.admin')
@section('title','Edit SEO – '.ucfirst($seo->page))
@section('content')
<div class="w-full max-w-5xl mx-auto">
    <a href="{{ route('admin.seo.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back to SEO</a>
    @if($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <form action="{{ route('admin.seo.update',$seo) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf @method('PUT')
        <div class="grid grid-cols-1 gap-5">
            <div>
                <label class="form-label">Meta Title <span style="color:#EF4444">*</span></label>
                <input type="text" name="meta_title" value="{{ old('meta_title',$seo->meta_title) }}" class="form-input" maxlength="200" required>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 50–60 characters</p>
            </div>
            <div>
                <label class="form-label">Meta Description <span style="color:#EF4444">*</span></label>
                <textarea name="meta_description" rows="3" class="form-input resize-none" maxlength="500" required>{{ old('meta_description',$seo->meta_description) }}</textarea>
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 150–160 characters</p>
            </div>
            <div>
                <label class="form-label">Page Content</label>
                <textarea name="content" rows="10" class="form-input rich-editor resize-y">{{ old('content',$seo->content) }}</textarea>
                <p class="text-xs mt-1" style="color:var(--muted)">Used for Privacy Policy and Terms &amp; Conditions pages. Basic HTML is supported.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Frontend Menu Label</label>
                    <input type="text" name="menu_label" value="{{ old('menu_label',$seo->menu_label) }}" class="form-input" placeholder="Privacy Policy">
                </div>
                <div>
                    <label class="form-label">Frontend Menu Icon</label>
                    <select name="menu_icon" class="form-input">
                        @foreach(['play'=>'Play','shield'=>'Shield','document'=>'Document','info'=>'Info','link'=>'Link'] as $icon=>$label)
                        <option value="{{ $icon }}" {{ old('menu_icon',$seo->menu_icon) === $icon ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div>
                <label class="form-label">Meta Keywords</label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords',$seo->meta_keywords) }}" class="form-input" placeholder="keyword1, keyword2, keyword3">
            </div>
            <div>
                <label class="form-label">OG Title (Social Share)</label>
                <input type="text" name="og_title" value="{{ old('og_title',$seo->og_title) }}" class="form-input">
            </div>
            <div>
                <label class="form-label">OG Description</label>
                <textarea name="og_description" rows="2" class="form-input resize-none">{{ old('og_description',$seo->og_description) }}</textarea>
            </div>
            <div>
                <label class="form-label">OG Image (Social Share)</label>
                @if($seo->og_image)<img src="{{ asset('storage/'.$seo->og_image) }}" alt="" class="h-24 rounded-lg object-cover mb-2">@endif
                <input type="file" name="og_image" class="form-input" accept="image/*">
                <p class="text-xs mt-1" style="color:var(--muted)">Recommended: 1200×630px</p>
            </div>
            <div>
                <label class="form-label">Canonical URL</label>
                <input type="url" name="canonical_url" value="{{ old('canonical_url',$seo->canonical_url) }}" class="form-input" placeholder="https://aakardermatology.com/page">
            </div>
            <div>
                <label class="flex items-center gap-2 text-sm cursor-pointer">
                    <input type="hidden" name="no_index" value="0">
                    <input type="checkbox" name="no_index" value="1" {{ old('no_index',$seo->no_index) ? 'checked':'' }}>
                    <span style="color:var(--text)">No Index (hide from search engines)</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="btn-primary">Save SEO Settings</button>
            <a href="{{ route('admin.seo.index') }}" class="btn-outline">Cancel</a>
        </div>
    </form>
</div>
@endsection
