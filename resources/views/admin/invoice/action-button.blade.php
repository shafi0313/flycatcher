@php
$actions = [
'show' =>route('admin.invoice.show', $invoice->id),
'print' =>route('admin.invoice.pdf', $invoice->id),

];
@endphp

<x-action-component :actions="$actions" status="{{ $invoice->status }}" />