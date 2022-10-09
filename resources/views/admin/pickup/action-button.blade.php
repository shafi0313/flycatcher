@php
    $actions = [
                    'delete' =>route('admin.pickup-request.destroy', $pickupRequest->id),
                ];
@endphp

<x-action-component :actions="$actions" status="{{ $pickupRequest->status }}" />
