@extends('layouts.master')
@section('title', 'Rider add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Rider list'=>route('admin.rider.index'),
    'Rider create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Rider create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Rider Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.rider.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="area_id">Select Hub <small class="text-danger">*</small></label>
                                        <select class="select2 form-control form-control-sm" name="hub_id" id="hub_id">
                                            @foreach($hubs as $hub)
                                            <option value="{{$hub->id}}">{{$hub->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('hub_id'))
                                        <small class="text-danger">{{$errors->first('hub_id')}}</small>
                                        @endif
                                    </div>

                                    {{-- <div class="form-group col-md-6">--}}
                                    {{-- <label for="area_id">Select Area <small class="text-danger">*</small></label>--}}
                                    {{-- <select class="select2 form-control form-control-sm" name="area_id" id="area_id">--}}
                                    {{-- @foreach($areas as $area)--}}
                                    {{-- <option value="{{$area->id}}" >{{$area->area_name}}({{$area->area_code}})</option>--}}
                                    {{-- @endforeach--}}
                                    {{-- </select>--}}
                                    {{-- @if($errors->has('area_id'))--}}
                                    {{-- <small class="text-danger">{{$errors->first('area_id')}}</small>--}}
                                    {{-- @endif--}}
                                    {{-- </div>--}}

                                    <div class="form-group col-md-6">
                                        <label for="area_id">Select Sub Area <small class="text-danger">*</small></label>
                                        <select class="select2 form-control form-control-sm" name="sub_area_id[]" id="sub_area_id" multiple="">
                                            @foreach($finalAreas as $subArea)
                                            <option value="{{$subArea->id}}">{{$subArea->name}}({{$subArea->code}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('sub_area_id'))
                                        <small class="text-danger">{{$errors->first('sub_area_id')}}</small>
                                        @endif
                                    </div>


                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Rider Name <small class="text-danger">*</small></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Rider Name" value="{{old('name')}}">
                                            @if($errors->has('name'))
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="email">Rider Email</label>
                                            <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="Enter email" value="{{old('email')}}">
                                            @if($errors->has('email'))
                                            <small class="text-danger">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="mobile">Rider mobile <small class="text-danger">*</small></label>
                                            <input type="number" class="form-control form-control-sm" id="mobile" name="mobile" placeholder="Enter phone number" value="{{old('mobile')}}">
                                            @if($errors->has('mobile'))
                                            <small class="text-danger">{{$errors->first('mobile')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="nid">Rider NID number</label>
                                            <input type="text" class="form-control form-control-sm" id="nid" name="nid" placeholder="Enter Nid" value="{{old('nid')}}">
                                            @if($errors->has('nid'))
                                            <small class="text-danger">{{$errors->first('nid')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="present_address">Present Address <small class="text-danger">*</small></label>
                                            <textarea class="form-control form-control-sm" name="present_address" id="present_address" rows="3" placeholder="Give present address">{{old('present_address')}}</textarea>
                                            @if($errors->has('present_address'))
                                            <small class="text-danger">{{$errors->first('present_address')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="permanent_address">Permanent Address <small class="text-danger">*</small></label>
                                            <textarea class="form-control form-control-sm" name="permanent_address" id="permanent_address" rows="3" placeholder="Give present address">{{old('permanent_address')}}</textarea>
                                            @if($errors->has('permanent_address'))
                                            <small class="text-danger">{{$errors->first('permanent_address')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="salary_type">Salary type <small class="text-danger">*</small></label>

                                        <select class="form-control form-control-sm" name="salary_type" id="salary_type">
                                            <option value="" disabled selected>Select one</option>
                                            <option value="commission">Commission basis</option>
                                            <option value="fixed">Fixed salary</option>
                                        </select>
                                        @if($errors->has('salary_type'))
                                        <small class="text-danger">{{$errors->first('salary_type')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <div class="row" id="commission_salary" style="display: none">
                                    <div class=" col-md-12">
                                        <div class="form-group">
                                            <label for="commission_type">Commission type <small class="text-danger">(Required)</small></label>
                                            <select class="form-control form-control-sm" name="commission_type">
                                                <option value="" disabled selected>Select one</option>
                                                <option value="percentage">Percentage</option>
                                                <option value="fixed">Fixed</option>
                                            </select>
                                            @if($errors->has('commission_type'))
                                            <small class="text-danger">{{$errors->first('commission_type')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class=" col-md-12">
                                        <div class="form-group">
                                            <label for="commission_rate">Commission rate <small class="text-danger">(Required)</small></label>
                                            <input type="number" class="form-control form-control-sm" id="commission_rate" name="commission_rate" placeholder="Enter commission rate" value="{{old('commission_rate')}}">
                                            @if($errors->has('commission_rate'))
                                            <small class="text-danger">{{$errors->first('commission_rate')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#salary_type").click(function() {
            let salaryType = $('#salary_type :selected').val();
            console.log(salaryType);
            if (salaryType === 'commission') {
                $("#commission_salary").css({
                    display: "block"
                });
            } else {
                $("#commission_salary").css({
                    display: "none"
                });
            }
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            let area_id = $('#area_id').val();
            let status = $('#status').val();
            let date_range = $('#date_range').val();
            if (area_id == null) {
                alert('Please Select Area Right Now');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.area-wise-parcel-search') }}",
                    data: {
                        area_id: area_id,
                        status: status,
                        date_range: date_range,
                    },
                    success: function(response) {
                        console.log(response)
                        $("#searchResult").html(response);
                    }

                });
            }
        });
    });
</script>
@endpush