@extends('layouts.admin')
@section('title','Site Settings')

@section('content')
@php
    $logoOptions = json_decode(App\Models\SiteSetting::get('site_logos', '[]'), true) ?: [];
    if ($settings->flatten(1)->firstWhere('key', 'site_logo')?->value && ! in_array($settings->flatten(1)->firstWhere('key', 'site_logo')->value, $logoOptions, true)) {
        array_unshift($logoOptions, $settings->flatten(1)->firstWhere('key', 'site_logo')->value);
    }
@endphp

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="flex gap-2 overflow-x-auto pb-2 mb-6" role="tablist" aria-label="Settings sections">
        @foreach($groups as $tabGroup)
        <button type="button" class="settings-tab whitespace-nowrap px-4 py-2 rounded-lg text-sm font-semibold {{ $loop->first ? 'active' : '' }}"
                data-settings-tab="settings-panel-{{ $tabGroup }}" role="tab" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
            {{ $tabGroup === 'brand' ? 'Brand Colors' : ucfirst($tabGroup).' Settings' }}
        </button>
        @endforeach
    </div>

    @if($errors->any())
    <div class="alert-error mb-5">
        <ul class="list-disc list-inside space-y-0.5">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    @foreach($groups as $group)
    @if($settings->has($group))
    <div id="settings-panel-{{ $group }}" data-settings-panel class="bg-white rounded-2xl shadow-sm mb-6 overflow-hidden {{ $loop->first ? '' : 'hidden' }}"
         style="border:1px solid var(--border)">

        {{-- Group header --}}
        <div class="px-6 py-4 border-b flex items-center gap-3"
             style="border-color:var(--primary-light);
                    background:{{ $group === 'brand' ? 'var(--primary-light)' : '#fff' }}">
            @if($group === 'brand')
            <div class="w-7 h-7 rounded-lg flex items-center justify-center"
                 style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                </svg>
            </div>
            @endif
            <div>
                <h2 class="font-bold text-sm capitalize" style="color:var(--dark)">
                    {{ $group === 'brand' ? '🎨 Brand Colors' : ucfirst($group).' Settings' }}
                </h2>
                @if($group === 'brand')
                <p class="text-xs mt-0.5" style="color:var(--muted)">
                    Changes apply instantly to the live website — no rebuild needed.
                </p>
                @endif
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                @foreach($settings[$group] as $setting)
                @if(in_array($setting->key, ['header_logo', 'footer_logo', 'site_logos', 'header_logo_path', 'footer_logo_path', 'show_header_logo', 'show_footer_logo'], true))
                    @continue
                @endif
                <div class="{{ in_array($setting->type, ['textarea']) ? 'sm:col-span-2' : '' }}">
                    <label class="form-label" for="setting_{{ $setting->key }}">
                        {{ $setting->label }}
                    </label>

                    {{-- Color picker --}}
                    @if($setting->type === 'color')
                    <div class="color-picker-wrap">
                        <input type="color"
                               id="color_swatch_{{ $setting->key }}"
                               value="{{ old('settings.'.$setting->key, $setting->value ?: '#006E61') }}"
                               onchange="document.getElementById('color_text_{{ $setting->key }}').value=this.value;
                                         document.getElementById('color_hidden_{{ $setting->key }}').value=this.value;
                                         document.getElementById('color_preview_{{ $setting->key }}').style.background=this.value;">
                        <input type="text"
                               id="color_text_{{ $setting->key }}"
                               value="{{ old('settings.'.$setting->key, $setting->value ?: '#006E61') }}"
                               maxlength="7"
                               oninput="if(this.value.match(/^#[0-9a-fA-F]{6}$/)){
                                   document.getElementById('color_swatch_{{ $setting->key }}').value=this.value;
                                   document.getElementById('color_hidden_{{ $setting->key }}').value=this.value;
                                   document.getElementById('color_preview_{{ $setting->key }}').style.background=this.value;
                               }">
                        <input type="hidden"
                               id="color_hidden_{{ $setting->key }}"
                               name="settings[{{ $setting->key }}]"
                               value="{{ old('settings.'.$setting->key, $setting->value) }}">
                        {{-- Live preview swatch --}}
                        <div id="color_preview_{{ $setting->key }}"
                             class="w-8 h-8 rounded-lg border ml-auto flex-shrink-0"
                             style="background:{{ $setting->value ?: '#006E61' }};border-color:var(--border)"></div>
                    </div>

                    {{-- Image upload --}}
                    @elseif($setting->type === 'image')
                        @if($setting->key === 'site_logo')
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-3">
                            @forelse($logoOptions as $logoPath)
                            <div class="border rounded-xl p-3 flex items-center gap-4" style="border-color:var(--border)">
                                <img src="{{ asset('storage/'.$logoPath) }}" alt="Uploaded logo" class="h-16 w-28 object-contain flex-shrink-0">
                            </div>
                            @empty
                            <p class="text-sm" style="color:var(--muted)">No logos uploaded yet.</p>
                            @endforelse
                        </div>
                        @elseif($setting->value)
                        <div class="mb-2">
                            <img src="{{ asset('storage/'.$setting->value) }}" alt="{{ $setting->label }}"
                                 class="h-20 rounded-xl object-cover border" style="border-color:var(--border)">
                        </div>
                        @endif
                           @if($setting->key === 'site_logo')
                           <input type="file" name="images[site_logos][]" id="setting_site_logos" class="form-input" accept="image/*" multiple>
                           <p class="text-xs mt-1.5" style="color:var(--muted)">Choose one or more logo images. The first uploaded logo is used in the header and footer.</p>
                           @else
                           <input type="file" name="images[{{ $setting->key }}]" id="setting_{{ $setting->key }}" class="form-input" accept="image/*">
                           @endif
                        @php
                            $imgHints = [
                                'site_logo'    => '400×120 px PNG/SVG with transparent background. Max 200 KB.',
                                'header_logo'  => 'Logo shown in the website header. Max 200 KB.',
                                'footer_logo'  => 'Logo shown in the website footer. Max 200 KB.',
                                'site_favicon' => '64×64 px or 512×512 px square PNG. Displays in browser tab.',
                                'hero_image'   => '1920×1080 px (16:9). Used as hero background. Max 600 KB.',
                                'hero_image_1' => '800×1000 px portrait (3:4). Right side of hero section. Max 400 KB.',
                                'hero_image_2' => '800×600 px landscape (4:3). Hero collage top-right cell. Max 300 KB.',
                                'hero_image_3' => '800×600 px landscape (4:3). Hero collage bottom-right cell. Max 300 KB.',
                                'hero_image_4' => '800×600 px landscape (4:3). Hero collage bottom-left cell. Max 300 KB.',
                                'hero_image_5' => '800×600 px landscape (4:3). Hero collage top cell. Max 300 KB.',
                                'doctor_photo' => '800×1000 px portrait (4:5). Shown in hero & about sections. Max 400 KB.',
                                'og_image'     => '1200×630 px (1.91:1). Used when sharing on Facebook/Twitter.',
                            ];
                            $hint = $imgHints[$setting->key] ?? null;
                        @endphp
                        @if($hint)
                        <p class="text-xs mt-1.5 flex items-start gap-1.5" style="color:var(--muted)">
                            <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span><strong>Recommended:</strong> {{ $hint }}</span>
                        </p>
                        @else
                        <p class="text-xs mt-1.5" style="color:var(--muted)">Upload a high-quality image at 2× the display size for sharp rendering on retina screens.</p>
                        @endif

                    {{-- Textarea --}}
                    @elseif($setting->type === 'textarea')
                        <textarea name="settings[{{ $setting->key }}]"
                                  id="setting_{{ $setting->key }}"
                                  rows="3" class="form-input resize-none">{{ old('settings.'.$setting->key, $setting->value) }}</textarea>

                    {{-- Boolean toggle --}}
                    @elseif($setting->type === 'boolean')
                        <label class="flex items-center gap-3 mt-1 cursor-pointer">
                            <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                            <input type="checkbox" name="settings[{{ $setting->key }}]" value="1"
                                   {{ filter_var(old('settings.'.$setting->key, $setting->value), FILTER_VALIDATE_BOOLEAN) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded" style="accent-color:var(--primary)">
                            <span class="text-sm" style="color:var(--muted)">Enable</span>
                        </label>

                    {{-- Hero Video Orientation selector --}}
                    @elseif($setting->key === 'hero_video_orientation')
                        <div class="flex gap-3">
                            @foreach(['landscape' => 'Landscape (16:9 — wider)', 'portrait' => 'Portrait (9:16 — tall)'] as $val => $lbl)
                            <label class="flex items-center gap-2 cursor-pointer px-4 py-2.5 rounded-xl border-2 transition-all text-sm font-semibold"
                                   style="border-color:{{ old('settings.'.$setting->key,$setting->value) === $val ? 'var(--primary)' : 'var(--border)' }};background:{{ old('settings.'.$setting->key,$setting->value) === $val ? 'var(--primary-light)' : '#fff' }};color:{{ old('settings.'.$setting->key,$setting->value) === $val ? 'var(--primary)' : 'var(--muted)' }}">
                                <input type="radio" name="settings[{{ $setting->key }}]" value="{{ $val }}"
                                       {{ old('settings.'.$setting->key,$setting->value) === $val ? 'checked' : '' }}
                                       class="sr-only">
                                @if($val === 'landscape')
                                <svg class="w-5 h-4" viewBox="0 0 20 14" fill="currentColor"><rect rx="2" width="20" height="14"/></svg>
                                @else
                                <svg class="w-3 h-5" viewBox="0 0 12 20" fill="currentColor"><rect rx="2" width="12" height="20"/></svg>
                                @endif
                                {{ $lbl }}
                            </label>
                            @endforeach
                        </div>
                        <p class="text-xs mt-1.5" style="color:var(--muted)">Choose based on whether the doctor's video is filmed horizontally or vertically (e.g. a phone recording is usually portrait).</p>

                    {{-- Hero Video URL — special rich field --}}
                    @elseif($setting->key === 'hero_video')
                        <div class="space-y-2">
                            <input type="url"
                                   name="settings[{{ $setting->key }}]"
                                   id="setting_{{ $setting->key }}"
                                   value="{{ old('settings.'.$setting->key, $setting->value) }}"
                                   placeholder="https://youtu.be/xxxx  or  https://vimeo.com/xxxx"
                                   class="form-input"
                                   oninput="updateHeroVideoPreview(this.value)">
                            <p class="text-xs flex items-start gap-1.5" style="color:var(--muted)">
                                <svg class="w-3.5 h-3.5 mt-0.5 flex-shrink-0" style="color:var(--primary)" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span>Paste a <strong>YouTube</strong> or <strong>Vimeo</strong> URL. The doctor intro video will appear in the hero section instead of the image mosaic. Leave blank to show the image mosaic.</span>
                            </p>
                            {{-- Live preview iframe --}}
                            <div id="hero-video-preview-wrap"
                                 class="{{ $setting->value ? '' : 'hidden' }} mt-2 rounded-xl overflow-hidden border"
                                 style="border-color:var(--border);aspect-ratio:16/9;max-width:420px;background:var(--dark)">
                                <iframe id="hero-video-preview-frame"
                                        src="{{ $setting->value ? \App\View\Components\HeroVideoEmbed::embedUrl($setting->value) : '' }}"
                                        class="w-full h-full"
                                        frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen></iframe>
                            </div>
                        </div>
                        <script>
                        function updateHeroVideoPreview(url) {
                            var wrap  = document.getElementById('hero-video-preview-wrap');
                            var frame = document.getElementById('hero-video-preview-frame');
                            var embed = heroVideoEmbedUrl(url);
                            if (embed) {
                                frame.src = embed;
                                wrap.classList.remove('hidden');
                            } else {
                                wrap.classList.add('hidden');
                                frame.src = '';
                            }
                        }
                        function heroVideoEmbedUrl(url) {
                            if (!url) return '';
                            // YouTube: youtu.be/ID  or  youtube.com/watch?v=ID  or  youtube.com/shorts/ID
                            var ytMatch = url.match(/(?:youtu\.be\/|youtube\.com\/(?:watch\?v=|shorts\/|embed\/))([A-Za-z0-9_-]{11})/);
                            if (ytMatch) return 'https://www.youtube.com/embed/' + ytMatch[1] + '?rel=0&modestbranding=1';
                            // Vimeo: vimeo.com/ID
                            var vmMatch = url.match(/vimeo\.com\/(\d+)/);
                            if (vmMatch) return 'https://player.vimeo.com/video/' + vmMatch[1] + '?dnt=1';
                            return '';
                        }
                        </script>

                    {{-- Text / URL --}}
                    @else
                        <input type="text" name="settings[{{ $setting->key }}]"
                               id="setting_{{ $setting->key }}"
                               value="{{ old('settings.'.$setting->key, $setting->value) }}"
                               class="form-input">
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @endforeach

    {{-- Save button --}}
    <div class="flex items-center gap-3">
        <button type="submit" class="btn-primary shadow-lg">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Save All Settings
        </button>
        <span class="text-xs" style="color:var(--muted)">Color changes apply instantly to the live site.</span>
    </div>
</form>

<style>
    .settings-tab { color: var(--muted); background: #fff; border: 1px solid var(--border); cursor: pointer; }
    .settings-tab.active { color: #fff; background: var(--primary); border-color: var(--primary); }
</style>
<script>
    document.querySelectorAll('[data-settings-tab]').forEach(function (tab) {
        tab.addEventListener('click', function () {
            document.querySelectorAll('[data-settings-tab]').forEach(function (item) {
                item.classList.toggle('active', item === tab);
                item.setAttribute('aria-selected', item === tab ? 'true' : 'false');
            });
            document.querySelectorAll('[data-settings-panel]').forEach(function (panel) {
                panel.classList.toggle('hidden', panel.id !== tab.dataset.settingsTab);
            });
        });
    });
</script>

@endsection
