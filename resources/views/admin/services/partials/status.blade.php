<form action="{{ route('admin.services.toggle', $service) }}" method="POST" class="inline">
    @csrf @method('PATCH')
    <button type="submit" class="badge {{ $service->is_active ? 'badge-green' : 'badge-red' }} cursor-pointer border-0 bg-transparent p-0">
        {{ $service->is_active ? 'Active' : 'Inactive' }}
    </button>
</form>