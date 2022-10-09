<div class="dt-action-buttons text-right">
    <div class="d-flex justify-content-start">
        <div>
            <button title="Edit Now" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editMobileBankingModal-{{$merchantBanking->id}}">
                {{bladeIcon('edit')}}
            </button>
        </div>
    </div>
    <div class="modal fade text-left" id="editMobileBankingModal-{{$merchantBanking->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Your Mobile Banking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('merchant.settings.mobile-banking.update', $merchantBanking->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rider_id">Select A Type <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="mobile_banking_id" id="mobile_banking_id">
                                <option value="" disabled>Select one</option>
                                @foreach($bankings as $banking)
                                    <option value="{{$banking->id}}" {{$banking->id === $merchantBanking->mobile_banking_id? 'selected': ' '}}>{{$banking->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('mobile_banking_id'))
                                <small class="text-danger">{{$errors->first('mobile_banking_id')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="rider_id">Mobile Number <span class="text-danger">*</span></label>
                            <input type="number" name="mobile_number" class="form-control" placeholder="Your Mobile Number" value="{{$merchantBanking->mobile_number}}">
                        </div>
                        <div class="form-group">
                            <label for="rider_id">Select A Type <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm" name="status" id="status">
                                <option value="active" {{$merchantBanking->status === 'active'? 'selected': ''}}>Active</option>
                                <option value="inactive" {{$merchantBanking->status === 'inactive'? 'selected': ''}}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                                <small class="text-danger">{{$errors->first('status')}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
