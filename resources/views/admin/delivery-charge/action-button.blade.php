@php
    $actions = [
                    'edit'=>route('admin.delivery-charge.edit', $charge->id),
                    'delete' =>route('admin.delivery-charge.destroy', $charge->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $charge->status }}" />


