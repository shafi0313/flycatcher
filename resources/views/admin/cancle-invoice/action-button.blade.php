@php
$actions = [
'show' =>route('admin.cancle-invoice.show', $invoice->id),

];
@endphp

<x-action-component :actions="$actions" status="{{ $invoice->status }}" />
