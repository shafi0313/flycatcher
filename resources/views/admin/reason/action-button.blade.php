@php
    $actions = [
                    'delete' =>route('admin.reason.destroy', $reason->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $reason->status }}" />


