@php
    $actions = [
                    'edit'=>route('admin.hub.edit', $hub->id),
                    'delete' =>route('admin.hub.destroy', $hub->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $hub->status }}" />


