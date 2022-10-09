<div class="row">
    <div class="form-group col-md-3">
        <label for="city_type_id">Select City type <small class="text-danger">(Required)</small></label>
        <select class="form-control select2" name="city_type_id" id="city_type_id">
            <option value="" disabled selected>Select one</option>
            @foreach($cityTypes as $cityType)
                <option value="{{$cityType->id}}" {{$cityType->id === $charge->city_type_id ? 'selected':'' }}>{{$cityType->name}}</option>
            @endforeach
        </select>
        @if($errors->has('city_type_id'))
            <small class="text-danger">{{$errors->first('city_type_id')}}</small>
        @endif

    </div>
    <div class="col-md-3 col-12 mb-1">
        <div class="form-group">
            <label for="weight_range_id">Select Weight Range <small class="text-danger">(Required)</small></label>
            <select class="form-control select2" name="weight_range_id" id="weight_range_id">
                <option value="" disabled selected>Select one</option>
                @foreach($weightRanges as $weightRange)
                    <option value="{{$weightRange->id}}" {{$weightRange->id === $charge->weight_range_id ? 'selected':''}}>{{$weightRange->min_weight}} - {{$weightRange->max_weight}} ( Code={{$weightRange->code}} )</option>
                @endforeach
            </select>
            @if($errors->has('weight_range_id'))
                <small class="text-danger">{{$errors->first('weight_range_id')}}</small>
            @endif
        </div>
    </div>
    <div class="col-md-3 col-12 mb-1">
        <div class="form-group">
            <label for="delivery_charge">Enter Delivery Charge <small class="text-danger">(Required)</small></label>
            <input type="number" class="form-control" id="delivery_charge" name="delivery_charge" placeholder="Enter Delivery Charge" value="{{$charge->delivery_charge}}" min="1">
            @if($errors->has('delivery_charge'))
                <small class="text-danger">{{$errors->first('delivery_charge')}}</small>
            @endif
        </div>
    </div>
    <div class="col-md-3 col-12 mb-1">
        <div class="form-group">
            <label for="cod">Enter COD charge <small class="text-danger">(Required)</small></label>
            <input type="number" class="form-control" id="cod" name="cod" placeholder="Enter COD" value="{{$charge->cod}}" min="0">
            @if($errors->has('cod'))
                <small class="text-danger">{{$errors->first('cod')}}</small>
            @endif
        </div>
    </div>
    <div class="col-md-3 col-12 mb-1">
        <label for="status">Select Status</label>
        <select class="form-control select2" name="status" id="status">
            <option value="active" {{$charge->status === 'active' ? 'selected' : ''}}>Active</option>
            <option value="inactive" {{$charge->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
        </select>
    </div>
</div>
<button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
