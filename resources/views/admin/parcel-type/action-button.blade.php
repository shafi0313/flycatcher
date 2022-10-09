@php
    $actions = [
                    'edit'=>route('admin.parcel-type.edit', $parcelType->id),
                    'delete' =>route('admin.parcel-type.destroy', $parcelType->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $parcelType->status }}" />


