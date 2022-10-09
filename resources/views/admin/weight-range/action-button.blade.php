@php
    $actions = [
                    'edit'=>route('admin.weight-range.edit', $weight->id),
                    'delete' =>route('admin.weight-range.destroy', $weight->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $weight->status }}" />


