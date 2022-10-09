@php
    $actions = [
                    'edit'=>route('admin.complaints.edit', $complaint->id),
                    'delete' =>route('admin.complaints.destroy', $complaint->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $complaint->status }}" />


