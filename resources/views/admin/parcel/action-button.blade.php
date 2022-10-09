@php
$actions['barcode'] = route('admin.barcode', $parcel->id);
$actions['show'] = route('admin.parcel.show', $parcel->id);
if(($parcel->status === 'received_at_office' || $parcel->status === 'pending') && $parcel->added_by_admin === auth('admin')->user()->id && $parcel->transit_count === 0){
$actions['edit'] = route('admin.parcel.edit', $parcel->id);
$actions['delete'] = route('admin.parcel.destroy', $parcel->id);
}

@endphp
<div class="d-flex justify-content-center">
    @if($parcel->delivery_status === 'hold' || $parcel->delivery_status === 'partial'|| $parcel->delivery_status === 'exchange'|| $parcel->delivery_status === 'cancelled')
    <div class="mr-1">
        <form action="{{route('admin.parcel.accept', $parcel->id)}}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-success btn-sm" type="submit" title="Accept Now">
                {{bladeIcon('accept')}}
            </button>
        </form>
    </div>
    @endif

    @if($parcel->status === 'hold_accept_by_incharge' && $parcel->delivery_status === 'hold_accept_by_incharge')
    <div class="mr-1">
        <form action="{{route('admin.hold.parcel.reassign', $parcel->id)}}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-warning btn-sm" type="submit" title="Hold Reassign Now">
                <i class="fas fa-exchange-alt"></i>
            </button>
        </form>
    </div>
    @endif

    @hasrole('Developer')
    @if($parcel->status === 'delivered' || $parcel->status === 'partial' || $parcel->status === 'cancelled')
    @isset($collection)
    @if($collection->rider_collected_status === 'collected' || $collection->rider_collected_status === 'transfer_request')
    <div class="mr-1">
        <form action="{{route('admin.parcel.undo', $parcel->id)}}" method="POST">
            @csrf
            @method('put')
            <button class="btn btn-warning btn-sm" type="submit" title="Undo Now">
                <i class="fas fa-undo"></i>
            </button>
        </form>
    </div>
    @endif
    @else
    @endisset
    @endif
    @if($parcel->status === 'wait_for_pickup' || $parcel->status === 'pending')
    <div class="mr-1">
        <form action="{{ route('admin.parcel.destroy', $parcel->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-sm confirm-text" type="submit" title="Delete Now">
                {{bladeIcon('delete')}}
            </button>
        </form>
    </div>
    @endif
    @endhasrole

    @if($parcel->is_transfer === 'yes')
    <div class="mr-1">
        <a class="btn btn-success btn-sm" href="{{route('admin.parcel.transfer.index', $parcel->id)}}" title="Show Transfer Request">
            <i class="fas fa-space-shuttle"></i>
        </a>
    </div>
    @endif

    @if(! $parcel->notes->isEmpty())
    <div class="mr-1">
        <div class="form-modal-ex">
            <!-- Button trigger modal -->
            <button type="button" title="Parcel Note" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#showNote-{{$parcel->id}}"><i class="fa fa-bars"></i>
            </button>
            <!-- Modal -->
            <div class="modal fade text-left" id="showNote-{{$parcel->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content p-1">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Parcel note</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <td>SL no</td>
                                    <td>Noted By</td>
                                    <td>Note</td>
                                    <td>Date</td>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($parcel->notes as $note)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>
                                        @if($note->guard_name === 'admin')
                                        {{$note->admin->name}} ({{$note->guard_name}})
                                        @elseif($note->guard_name === 'merchant')
                                        {{$note->merchant->name}} ({{$note->guard_name}})
                                        @elseif($note->guard_name === 'rider')
                                        {{$note->rider->name}}
                                        @endif

                                    </td>
                                    <td>{{$note->note}}</td>
                                    <td>{{$note->created_at->format('d:M Y')}}, {{$note->created_at->format('h:i A')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <x-action-component :actions="$actions" status="{{ $parcel->status }}" />
</div>