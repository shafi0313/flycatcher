<div class="button-group">
    <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modal-{{$pickupRequest->id}}">Assign A Rider</button>
</div>

<div class="modal fade text-left" id="modal-{{$pickupRequest->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel33">Parcel Assign form</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('admin.pickup-request.rider-assign', $pickupRequest->id)}}" method="POST">
                @csrf
                @method('put')
                <div class="modal-body">
                    <label for="rider_id">Select Rider <span class="text-danger">*</span></label>

                    <select class="form-control form-control-sm" name="rider_id" id="rider_id">
                        <option value="" disabled>Select one</option>
                        @foreach($riders as $rider)
                            <option value="{{$rider->id}}" >{{$rider->name}} ({{$rider->rider_code}})</option>
                        @endforeach
                    </select>
                    @if($errors->has('rider_id'))
                        <small class="text-danger">{{$errors->first('rider_id')}}</small>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Assign now</button>
                </div>
            </form>
        </div>
    </div>
</div>

