@extends('layouts.master')
@section('title', 'Merchant add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Merchant list'=>route('admin.merchant.index'),
    'Merchant create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Merchant create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Merchant Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.merchant.store')}}" method="POST" class="">
                                @csrf
                                <div class="row" id="vue_app">

                                    <div class="form-group col-md-4">
                                        <label for="area">Select area <span class="text-danger">*</span></label>

                                        <select class="select2 form-control select2-size-sm" name="area_id" id="area">
                                            <option value="" disabled>Select one</option>
                                            @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->area_name}} ({{$area->area_code}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('area_id'))
                                        <small class="text-danger">{{$errors->first('area_id')}}</small>
                                        @endif
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Merchant Name" value="{{old('name')}}">
                                            @if($errors->has('name'))
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Company Name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="company_name" placeholder="Enter Company Name" value="{{old('company_name')}}">
                                            @if($errors->has('company_name'))
                                            <small class="text-danger">{{$errors->first('company_name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant Email</label>
                                            <input type="email" class="form-control form-control-sm" id="name" name="email" placeholder="Enter Merchant Email" value="{{old('email')}}">
                                            @if($errors->has('email'))
                                            <small class="text-danger">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant mobile <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" id="name" name="mobile" placeholder="Enter Mobile number" value="{{old('mobile')}}">
                                            @if($errors->has('mobile'))
                                            <small class="text-danger">{{$errors->first('mobile')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="prefix">Merchant Prefix <span class="text-danger">( Must be 4 digits )</span></label>
                                            <input type="text" class="form-control form-control-sm" id="prefix" name="prefix" placeholder="Enter Prefix" value="{{old('prefix')}}">
                                            @if($errors->has('prefix'))
                                            <small class="text-danger">{{$errors->first('prefix')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Address Details</label>
                                            <textarea class="form-control form-control-sm" id="label-textarea" rows="3" placeholder="Give full adress">{{old('address')}}</textarea>
                                            @if($errors->has('address'))
                                            <small class="text-danger">{{$errors->first('address')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Submit</button>
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
    $(document).ready(function() {
        $('#district').on('change', function() {
            let id = $(this).val();
            $('#upazila').empty();
            $('#upazila').append(`<option value="0" disabled selected>Processing...</option>`);
            $.ajax({
                type: 'GET',
                url: "{{ route('getAjaxUpazillaData') }}?district_id=" + id,
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
