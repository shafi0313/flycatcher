<div class="d-flex justify-content-center">
    @if($parcel->status === 'wait_for_pickup')
        <div class="mr-1">
            <a href="{{ route('merchant.parcel.request.edit',$parcel->id)}}" class="btn btn-sm btn-primary"
               title="Edit">
                {{bladeIcon('edit')}}
            </a>
        </div>
        <div class="mr-1">
            <a href="{{ route('merchant.parcel.request.delete',$parcel->id)}}" class="btn btn-sm btn-danger confirm-text"
               title="Delete">
                {{bladeIcon('delete')}}
            </a>
        </div>
    @endif

    @if(! $parcel->notes->isEmpty())
        <div class="mr-1">
            <div class="form-modal-ex">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                        data-target="#showNote-{{$parcel->id}}"><i class="fa fa-bars"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade text-left" id="showNote-{{$parcel->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="myModalLabel33" aria-hidden="true">
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
                                                {{$note->admin->name ?? ''}} ({{$note->guard_name}})
                                            @elseif($note->guard_name === 'merchant')
                                                {{$note->merchant->name ?? ''}} ({{$note->guard_name}})
                                            @elseif($note->guard_name === 'rider')
                                                {{$note->rider->name ?? ''}}
                                            @endif

                                        </td>
                                        <td>{{$note->note}}</td>
                                        <td>{{$note->created_at->format('d:M Y')}}
                                            , {{$note->created_at->format('h:i A')}}</td>
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
</div>
