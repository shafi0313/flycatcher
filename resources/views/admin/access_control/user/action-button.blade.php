@php
    $actions = [
                    'edit'=>route('admin.admin.edit', $admin->id),
                   // 'delete' =>route('admin.admin.destroy', $admin->id),
                ];
@endphp

<div class="d-flex justify-content-center">
    <x-action-component :actions="$actions" status="{{ $admin->status }}" />
    <div class="ml-1">
        <form action="{{ route('admin.admin.password.reset', $admin->id) }}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-warning btn-sm" type="submit" title="Password Reset">
                <i class="fas fa-key"></i>
            </button>
        </form>
    </div>

    <div class="mr-1">
        <a href="{{route('admin.admin.login', $admin->id)}}" class="btn btn-sm btn-info ml-1" title=" Go to Dashboard">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
</div>



