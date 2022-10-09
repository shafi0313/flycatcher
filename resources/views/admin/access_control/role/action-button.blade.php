@php
    $actions = [
                    'edit'=>route('admin.role.edit', $role->id),
                    'delete'=>route('admin.role.destroy', $role->id),
                ];
@endphp

<div class="d-flex justify-content-center">
    <x-action-component :actions="$actions" status="{{ $role->status }}" />
</div>
