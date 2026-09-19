<div class="flex gap-2">
    <a href="{{ route('admin.services.edit', $service) }}" class="badge badge-blue w-8 h-8 justify-center p-0" style="text-decoration:none" title="Edit service" aria-label="Edit service">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 8.5-8.5z"/></svg>
    </a>
    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="delete-form" data-delete-message="This service will be permanently deleted.">
        @csrf @method('DELETE')
        <button type="submit" class="badge badge-red w-8 h-8 justify-center p-0 border-0 cursor-pointer" title="Delete service" aria-label="Delete service">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M4 7h16m-9-3h4a1 1 0 011 1v2H8V5a1 1 0 011-1z"/></svg>
        </button>
    </form>
</div>