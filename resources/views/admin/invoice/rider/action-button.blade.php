@php
$actions = [
'show' =>route('admin.rider.invoice.show', $rider_invoice->id),

];
@endphp

<x-action-component :actions="$actions" status="{{ $rider_invoice->status }}" />
