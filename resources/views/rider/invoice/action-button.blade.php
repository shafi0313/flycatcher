@php
$actions = [
'show' =>route('rider.invoices.show', $invoice->id),

];
@endphp

<x-action-component :actions="$actions" status="{{ $invoice->status }}" />
