<div class="row">
    <div class="form-group col-md-6">
        <input type="hidden" name="parcel_id" value="{{$parcel_id}}">
        <label for="city_type_id">Select Area</label>
        <select class="form-control select2" name="transfer_sub_area" id="transfer_sub_area">
            @foreach($rider->assign_areas as $assign_areas)
            <option value="{{$assign_areas->sub_area->id}}">{{$assign_areas->sub_area->name}}</option>
            @endforeach
        </select>
        @if($errors->has('transfer_for'))
        <small class="text-danger">{{$errors->first('transfer_for')}}</small>
        @endif
    </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="submit">Transfer Request</button>
    </div>
</div>
