<div class="dt-action-buttons text-right">
    <div class="d-flex justify-content-start">
        <div>
            <button title="Edit Now" type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#editMobileBankingModal-{{$merchantBankAccount->id}}">
                {{bladeIcon('edit')}}
            </button>
        </div>
    </div>
    <div class="modal fade text-left" id="editMobileBankingModal-{{$merchantBankAccount->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">Edit Your Bank Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('merchant.settings.bank-info.update', $merchantBankAccount->id)}}" method="POST">
                    @csrf
                    @method('put')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="rider_id">Select A Type <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm select2" name="bank_id" id="bank_id">
                                <option value="" disabled>Select one</option>
                                @foreach($banks as $bank)
                                    <option value="{{$bank->id}}" {{$bank->id === $merchantBankAccount->bank_id? 'selected':''}}>{{$bank->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('bank_id'))
                                <small class="text-danger">{{$errors->first('bank_id')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="account_name">Branch Name <span class="text-danger">*</span></label>
                            <input type="text" id="account_name" name="branch_name" class="form-control" placeholder="Branch Name" value="{{$merchantBankAccount->account_name}}">
                            @if($errors->has('account_name'))
                                <small class="text-danger">{{$errors->first('account_name')}}</small>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="account_name">Account Name <span class="text-danger">*</span></label>
                            <input type="text" id="account_name" name="account_name" class="form-control" placeholder="Account Name" value="{{$merchantBankAccount->account_name}}">
                            @if($errors->has('account_name'))
                                <small class="text-danger">{{$errors->first('account_name')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number <span class="text-danger">*</span></label>
                            <input type="text" id="account_number" name="account_number" class="form-control" placeholder="Your Account Number" value="{{$merchantBankAccount->account_number}}">
                            @if($errors->has('account_number'))
                                <small class="text-danger">{{$errors->first('account_number')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="routing_number">Routing Number</label>
                            <input type="text" name="routing_number" id="routing_number" class="form-control" placeholder="Your Routing Number" value="{{$merchantBankAccount->routing_number}}">
                            @if($errors->has('routing_number'))
                                <small class="text-danger">{{$errors->first('routing_number')}}</small>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="rider_id">Select Status <span class="text-danger">*</span></label>
                            <select class="form-control form-control-sm select2" name="status" id="status">
                                <option value="active" {{$merchantBankAccount->status === 'active' ? 'selected': ''}}>Active</option>
                                <option value="active" {{$merchantBankAccount->status === 'inactive' ? 'selected': ''}}>Inactive</option>
                            </select>
                            @if($errors->has('status'))
                                <small class="text-danger">{{$errors->first('status')}}</small>
                            @endif
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
