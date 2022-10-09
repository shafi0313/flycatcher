@extends('layouts.master')
@section('title', 'Area update')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Area list'=>route('admin.area.index'),
                'Area update'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Area update' :links="$links" />
        <div class="content-body">
            <!-- Basic Inputs start -->
            <section id="basic-input">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Area Create</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{route('admin.area.update', $area->id)}}" method="POST" class="">
                                    @method('put')
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="district_id">District</label>

                                            <select class="form-control form-control-sm" name="city_type_id" id="district_id">
                                                <option value="">Select one</option>
                                                @foreach($cityTypes as $cityType)
                                                    <option value="{{$cityType->id}}" {{$cityType->id === $area->city_type_id ? 'selected' : ''}}>{{$cityType->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('city_type_id'))
                                                <small class="text-danger">{{$errors->first('city_type_id')}}</small>
                                            @endif

                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="district_id">District</label>

                                            <select class="form-control form-control-sm" name="district_id" id="district">
                                                <option value="">Select one</option>
                                                @foreach($districts as $district)
                                                    <option value="{{$district->id}}" {{$district->id === $area->district_id ? 'selected' : ''}}>{{$district->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('district_id'))
                                                <small class="text-danger">{{$errors->first('district_id')}}</small>
                                            @endif

                                        </div>
{{--                                        <div class="form-group col-md-6">--}}
{{--                                            <label for="upazila_id">Upazila</label>--}}

{{--                                            <select class="form-control form-control-sm" name="upazila_id" id="upazila_id">--}}
{{--                                                <option value="">Select one</option>--}}
{{--                                                @foreach($upazilas as $upazila)--}}
{{--                                                    <option value="{{$upazila->id}}" {{$upazila->id === $area->upazila_id ? 'selected' : ''}}>{{$upazila->name}}</option>--}}
{{--                                                @endforeach--}}
{{--                                            </select>--}}
{{--                                            @if($errors->has('upazila_id'))--}}
{{--                                                <small class="text-danger">{{$errors->first('upazila_id')}}</small>--}}
{{--                                            @endif--}}
{{--                                        </div>--}}
                                        <div class="form-group col-md-6">
                                            <label for="upazila_id">Upazila</label>
                                            <select class="form-control form-control-sm" name="upazila_id" id="upazila"></select>
                                            @if($errors->has('upazila_id'))
                                                <small class="text-danger">{{$errors->first('upazila_id')}}</small>
                                            @endif
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Area name</label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="area_name" placeholder="Enter Area Name" value="{{$area->area_name}}">
                                                @if($errors->has('area_name'))
                                                    <small class="text-danger">{{$errors->first('area_name')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Postal code</label>
                                                <input type="text" class="form-control form-control-sm" id="name" name="area_code" placeholder="Enter postal code" value="{{$area->area_code}}">
                                                <input type="hidden"  id="id" name="id" value="{{$area->id}}">
                                                @if($errors->has('area_code'))
                                                    <small class="text-danger">{{$errors->first('area_code')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12 mb-1">
                                            <label for="upazila_id">Select Status</label>

                                            <select class="form-control form-control-sm" name="status" id="upazila_id">
                                                <option value="active" {{$area->status === 'active' ? 'selected' : ''}}>Active</option>
                                                <option value="inactive" {{$area->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update now</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#district').on('change', function () {
                let id = $(this).val();
                $('#upazila').empty();
                $('#upazila').append(`<option value="0" disabled selected>Processing...</option>`);
                $.ajax({
                    type: 'GET',
                    url:  "{{ route('getAjaxUpazillaData') }}?district_id=" + id,
                    success: function(data) {
                        $('#upazila').html(data.html);
                    }
                    // success: function (response) {
                    //     var response = JSON.parse(response);
                    //     console.log(response);
                    //     $('#upazila').empty();
                    //     $('#upazila').append(`<option value="0" disabled selected>Select Sub Category*</option>`);
                    //     response.forEach(data => {
                    //         $('#upazila').append(`<option value="${data['id']}">${data['name']}</option>`);
                    //     });
                    // }
                });
            });
        });
    </script>
@endpush
