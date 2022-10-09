@php
$actions = [
'edit'=>route('admin.rider.edit', $rider->id),
//'delete' =>route('admin.rider.destroy', $rider->id),
];
@endphp

<div class="d-flex justify-content-center">
    <x-action-component :actions="$actions" status="{{ $rider->status }}" />
    @can('reset-rider-password')
    <div class="ml-1">
        <form action="{{ route('admin.rider.password.reset', $rider->id) }}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-warning btn-sm" type="submit" title="Password Reset">
                <i class="fas fa-key"></i>
            </button>
        </form>
    </div>
    @endcan
    @can('goto-dashboard-rider')
    <div class="mr-1">
        <a href="{{route('admin.rider.login', $rider->id)}}" class="btn btn-sm btn-info ml-1" title=" Go to Dashboard">
            <i class="fas fa-arrow-circle-right"></i>
        </a>
    </div>
    @endcan
</div>