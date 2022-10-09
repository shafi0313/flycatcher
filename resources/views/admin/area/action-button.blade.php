@php
    $actions = [
                    'edit'=>route('admin.area.edit', $area->id),
                    //'delete' =>route('admin.area.destroy', $area->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $area->status }}" />


