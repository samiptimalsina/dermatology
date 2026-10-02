<div class="flex items-center gap-2 whitespace-nowrap">
    <button type="button"
            class="badge badge-blue border-0 cursor-pointer"
            data-user-edit
            data-user-id="{{ $user->id }}"
            data-user-name="{{ $user->name }}"
            data-user-email="{{ $user->email }}"
            data-user-roles="{{ $user->roles->pluck('name')->toJson() }}">
        Edit
    </button>
    @if(auth()->id() !== $user->id)
    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Delete this user account?')">
        @csrf
        @method('DELETE')
        <button type="submit" class="badge badge-red border-0 cursor-pointer">Delete</button>
    </form>
    @endif
</div>
