@php
    $actions = [
                    'edit'=>route('admin.permission.edit', $permission->id),
                ];
@endphp

<div class="d-flex justify-content-center">
    <x-action-component :actions="$actions" status="{{ $permission->status }}" />
</div>




