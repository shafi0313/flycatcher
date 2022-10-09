@php
$actions = [
'show' =>route('admin.incharge.invoice.show', $invoice->id),

];
@endphp

<x-action-component :actions="$actions" status="{{ $invoice->status }}" />
