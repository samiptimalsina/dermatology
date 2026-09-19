@php
    $menuIconPaths = [
        'home' => 'M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6',
        'services' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
        'gallery' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
        'blog' => 'M5 4h10a2 2 0 012 2v14H7a2 2 0 01-2-2V4zm4 0v4h4V4M8 13h6m-6 3h6',
        'contact' => 'M3 8l9 6 9-6M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
        'play' => 'M8 5v14l11-7z',
        'shield' => 'M12 3l7 4v5c0 4.5-3 7.7-7 9-4-1.3-7-4.5-7-9V7l7-4z',
        'document' => 'M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2zm7 0v5h4',
        'info' => 'M12 16v-4m0-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'link' => 'M10 13a5 5 0 007.54.54l2-2a5 5 0 00-7.07-7.07l-1.15 1.15m2.68 5.38a5 5 0 01-7.54-.54l-2-2a5 5 0 017.07-7.07l1.15-1.15',
    ];
@endphp
<svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menuIconPaths[$icon] ?? $menuIconPaths['info'] }}"/>
</svg>