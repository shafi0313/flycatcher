<div class="btn-group">
    @if($pickupRequest->status === 'assigned')
        <div class="mr-1">
            <form action="{{ route('rider.pickup-request.accept', $pickupRequest->id) }}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm" type="submit" title="Accept Now">
                    {{ bladeIcon('accept') }}
                </button>
            </form>
        </div>
    @endif
    @if($pickupRequest->status === 'accepted')
        <div class="mr-1">
            <form action="{{ route('rider.pickup-request.pickup', $pickupRequest->id) }}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm" type="submit" title="Picked Now">
                    {{ bladeIcon('picked') }}
                </button>
            </form>
        </div>
    @endif
</div>
