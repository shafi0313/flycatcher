@php
    $actions = [
                    'edit'=>route('admin.sub-area.edit', $subArea->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $subArea->status }}" />


