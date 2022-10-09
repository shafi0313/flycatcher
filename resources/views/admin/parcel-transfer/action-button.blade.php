<div class="d-flex justify-content-center">
    @if($parcelTransfer->status === 'pending')
        <div class="mr-1">
            <form action="{{route('admin.parcel.transfer.accept', $parcelTransfer->id)}}" method="POST">
                @csrf
                @method('put')
                <button class="btn btn-success btn-sm" type="submit" title="Accept Now">
                    {{bladeIcon('accept')}}
                </button>
            </form>
        </div>
    @endif
{{--    @if($parcel->status === 'delivered' ||  $parcel->status === 'partial' || $parcel->status === 'cancelled')--}}
{{--        @isset($collection)--}}
{{--            @if($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request')--}}
{{--                <div class="mr-1">--}}
{{--                    <form action="{{route('admin.parcel.undo', $parcel->id)}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        @method('put')--}}
{{--                        <button class="btn btn-warning btn-sm" type="submit" title="Undo Now">--}}
{{--                            <i class="fas fa-undo"></i>--}}
{{--                        </button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--        @else--}}
{{--        @endisset--}}
{{--    @endif--}}

</div>


