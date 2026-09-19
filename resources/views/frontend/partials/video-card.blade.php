<a href="{{ route('videos.show', $video) }}" class="video-card" style="text-decoration:none">
    <div class="relative overflow-hidden" style="height:132px;background:linear-gradient(135deg,var(--primary-light),var(--accent-light))">
        <img src="{{ $video->thumbnail }}" alt="{{ $video->title }}" class="w-full h-full object-cover opacity-65">
        <span class="absolute inset-0 flex items-center justify-center">
            <span class="video-play-small" aria-hidden="true">
                <svg class="w-4 h-4 ml-0.5" fill="currentColor" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
            </span>
        </span>
        @if($video->duration)<span class="video-duration absolute bottom-2 right-2">{{ $video->duration }}</span>@endif
    </div>
    <div class="p-3">
        <h3 class="font-semibold text-sm leading-snug" style="color:var(--dark)">{{ $video->title }}</h3>
        <span class="text-xs mt-1 block" style="color:var(--muted)">Watch tutorial</span>
    </div>
</a>