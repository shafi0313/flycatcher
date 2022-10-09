
@php
    $actions = [
                    'show' =>route('merchant.invoice.show', $invoice->id),
                ];
@endphp

<div class="d-flex">
    <x-action-component :actions="$actions" status="{{ $invoice->status }}" />
    @if($invoice->status === 'pending')
        <div class="mr-1">
            <form action="{{route('merchant.invoice.accept', $invoice->id)}}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-primary btn-sm" type="submit" title="Accept Now">
                    {{ bladeIcon('accept') }}
                </button>
            </form>
        </div>
    @endif
</div>

