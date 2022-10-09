@php
    if($pickupRequest->status === 'pending'){
        $actions['edit'] = route('merchant.pickup-request.edit', $pickupRequest->id);
    }
    $actions['delete'] = route('merchant.pickup-request.destroy', $pickupRequest->id);
@endphp

<x-action-component :actions="$actions" status="{{ $pickupRequest->status }}" />
