@php
$actions = [
'show'=>route('admin.investments.show', $investment->id),
'edit'=>route('admin.investments.edit', $investment->id),
'delete' =>route('admin.investments.destroy', $investment->id),
];
@endphp

<x-action-component :actions="$actions" status="{{ $investment->status }}" />