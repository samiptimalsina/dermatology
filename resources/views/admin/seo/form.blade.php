@extends('layouts.admin')
@section('title','Edit SEO – '.ucfirst($seo->page))
@section('content')
<div class="w-full">
    <a href="{{ route('admin.seo.index') }}" class="text-sm mb-5 inline-flex items-center gap-1" style="color:var(--muted);text-decoration:none">← Back to SEO</a>
    @if($errors->any())<div class="alert-error mb-5"><ul class="list-disc list-inside">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif

    <form action="{{ route('admin.seo.update',$seo) }}" method="POST" enctype="multipart/form-data"
          class="bg-white rounded-2xl shadow-sm p-6 space-y-5">
        @csrf @method('PUT')
        @if($seo->page === 'about')
        <section class="space-y-5 rounded-lg border p-5" style="border-color:var(--border)">
            <div>
                <h2 class="font-bold text-lg" style="color:var(--dark)">About Page Settings</h2>
                <p class="text-sm mt-1" style="color:var(--muted)">These values are shared with Settings → About and Stats.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label" for="about_doctor_name">Doctor Name</label>
                    <input type="text" id="about_doctor_name" name="about_settings[doctor_name]"
                           value="{{ old('about_settings.doctor_name', $aboutSettings->get('doctor_name')?->value) }}" class="form-input" maxlength="255">
                </div>
                <div>
                    <label class="form-label" for="about_doctor_title">Doctor Title</label>
                    <input type="text" id="about_doctor_title" name="about_settings[doctor_title]"
                           value="{{ old('about_settings.doctor_title', $aboutSettings->get('doctor_title')?->value) }}" class="form-input" maxlength="255">
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label" for="about_doctor_bio">Doctor Bio</label>
                    <textarea id="about_doctor_bio" name="about_settings[doctor_bio]" rows="5" class="form-input resize-y">{{ old('about_settings.doctor_bio', $aboutSettings->get('doctor_bio')?->value) }}</textarea>
                </div>
                @foreach(['doctor_photo' => 'Doctor Photo', 'about_clinic_image' => 'About Clinic Image'] as $imageKey => $imageLabel)
                <div>
                    <label class="form-label" for="about_image_{{ $imageKey }}">{{ $imageLabel }}</label>
                    @if($aboutSettings->get($imageKey)?->value)
                    <img src="{{ asset('storage/'.$aboutSettings->get($imageKey)->value) }}" alt="{{ $imageLabel }}" class="h-24 rounded-lg object-cover mb-2">
                    @endif
                    <input type="file" id="about_image_{{ $imageKey }}" name="about_images[{{ $imageKey }}]" class="form-input" accept="image/jpeg,image/png,image/webp">
                </div>
                @endforeach
                <div>
                    <label class="form-label" for="about_stat_years">Years Experience</label>
                    <input type="text" id="about_stat_years" name="about_settings[stat_years]"
                           value="{{ old('about_settings.stat_years', $aboutSettings->get('stat_years')?->value) }}" class="form-input" maxlength="50">
                </div>
                <div>
                    <label class="form-label" for="about_stat_patients">Happy Patients</label>
                    <input type="text" id="about_stat_patients" name="about_settings[stat_patients]"
                           value="{{ old('about_settings.stat_patients', $aboutSettings->get('stat_patients')?->value) }}" class="form-input" maxlength="50">
                </div>
            </div>
        </section>
        @endif
        @if($seo->page === 'contact')
        <section class="space-y-5 rounded-lg border p-5" style="border-color:var(--border)">
            <div>
                <h2 class="font-bold text-lg" style="color:var(--dark)">Contact Page Settings</h2>
                <p class="text-sm mt-1" style="color:var(--muted)">These values are shared with Settings → Contact.</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label" for="contact_phone">Phone</label>
                    <input type="tel" id="contact_phone" name="contact_settings[contact_phone]"
                           value="{{ old('contact_settings.contact_phone', $contactSettings->get('contact_phone')?->value) }}" class="form-input" maxlength="50">
                </div>
                <div>
                    <label class="form-label" for="contact_phone2">Phone 2</label>
                    <input type="tel" id="contact_phone2" name="contact_settings[contact_phone2]"
                           value="{{ old('contact_settings.contact_phone2', $contactSettings->get('contact_phone2')?->value) }}" class="form-input" maxlength="50">
                </div>
                <div>
                    <label class="form-label" for="contact_email">Email</label>
                    <input type="email" id="contact_email" name="contact_settings[contact_email]"
                           value="{{ old('contact_settings.contact_email', $contactSettings->get('contact_email')?->value) }}" class="form-input" maxlength="255">
                </div>
                <div>
                    <label class="form-label" for="contact_hours">Office Hours</label>
                    <input type="text" id="contact_hours" name="contact_settings[contact_hours]"
                           value="{{ old('contact_settings.contact_hours', $contactSettings->get('contact_hours')?->value) }}" class="form-input" maxlength="255">
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label" for="contact_address">Address</label>
                    <textarea id="contact_address" name="contact_settings[contact_address]" rows="3" class="form-input resize-y">{{ old('contact_settings.contact_address', $contactSettings->get('contact_address')?->value) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label" for="google_maps_embed">Google Maps Embed URL</label>
                    <textarea id="google_maps_embed" name="contact_settings[google_maps_embed]" rows="2" class="form-input resize-y">{{ old('contact_settings.google_maps_embed', $contactSettings->get('google_maps_embed')?->value) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <label class="form-label" for="contact_map_image">Clinic Map Image</label>
                    @if($contactSettings->get('contact_map_image')?->value)
                    <img src="{{ asset('storage/'.$contactSettings->get('contact_map_image')->value) }}" alt="Clinic map preview" class="h-24 rounded-lg object-cover mb-2">
                    @endif
                    <input type="file" id="contact_map_image" name="contact_images[contact_map_image]" class="form-input" accept="image/jpeg,image/png,image/webp">
                </div>
            </div>
        </section>
        @endif
        <div class="grid grid-cols-1 gap-5">
            <div>
                <label class="form-label">Page Slug <span style="color:#EF4444">*</span></label>
                <input type="text" name="slug" value="{{ old('slug',$seo->slug) }}" class="form-input" maxlength="255" pattern="[a-z0-9]+(-[a-z0-9]+)*" onblur="this.value = this.value.trim()" required>
                <p class="text-xs mt-1" style="color:var(--muted)">Lowercase letters, numbers, and hyphens only.</p>
            </div>
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
