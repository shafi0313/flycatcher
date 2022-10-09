@php
    $actions = [
    'show' =>route('rider.parcel.show', $parcel->id),
    ];
@endphp
<div class="d-flex align-items-center">
    <div class="modal-size-default d-inline-block mr-1">
        @if($parcel->status === 'pending')
            <form action="{{route('rider.parcel.accept', $parcel->id)}}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm" type="submit" title="Accept Now">
                    {{ bladeIcon('accept') }}
                </button>
            </form>
        @endif

        @if($parcel->status === 'transit')
            <a href="{{route('rider.parcel.status.change', $parcel->id)}}" class="btn btn-primary btn-sm">Change Status</a>
        @endif
    </div>

    <x-action-component :actions="$actions" status="{{ $parcel->status }}"/>
</div>

