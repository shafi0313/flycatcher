@extends('layouts.master')
@section('title', 'Merchant update')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Merchant list'=>route('admin.merchant.index'),
    'Merchant Update'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Merchant update' :links="$links" />
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
                            <form action="{{route('admin.merchant.update', $merchant->id)}}" method="POST" class="">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="area">Select area <span class="text-danger">*</span></label>

                                        <select class="select2 form-control form-control-sm" name="area_id" id="area">
                                            <option value="" disabled>Select one</option>
                                            @foreach($areas as $area)
                                            <option value="{{$area->id}}" {{$area->id === $merchant->area_id ? 'selected' : ''}}>{{$area->area_name}} ({{$area->area_code}})</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('area_id'))
                                        <small class="text-danger">{{$errors->first('area_id')}}</small>
                                        @endif

                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="name" placeholder="Enter Merchant Name" value="{{$merchant->name}}">
                                            <input type="hidden" name="id" value="{{$merchant->id}}">
                                            @if($errors->has('name'))
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="prefix">Merchant prefix <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="prefix" name="prefix" placeholder="Enter Merchant Prefix" value="{{$merchant->prefix}}">
                                            @if($errors->has('name'))
                                            <small class="text-danger">{{$errors->first('name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Company name <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="company_name" placeholder="Enter Company Name" value="{{$merchant->company_name}}">
                                            @if($errors->has('company_name'))
                                            <small class="text-danger">{{$errors->first('company_name')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant email</label>
                                            <input type="email" class="form-control form-control-sm" id="name" name="email" placeholder="Enter Merchant Email" value="{{$merchant->email}}">
                                            @if($errors->has('email'))
                                            <small class="text-danger">{{$errors->first('email')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="name">Merchant mobile <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="name" name="mobile" placeholder="Enter Mobile number" value="{{$merchant->mobile}}">
                                            @if($errors->has('mobile'))
                                            <small class="text-danger">{{$errors->first('mobile')}}</small>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="enable">Make enable or disable</label>

                                        <select class="form-control form-control-sm" name="is_active" id="enable">
                                            <option value="enable" {{$merchant->status === 'enable' ? 'selected' : ''}}>Enable</option>
                                            <option value="disable" {{$merchant->status === 'disable' ? 'selected' : ''}}>Disable</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="status">Select Status</label>

                                        <select class="form-control form-control-sm" name="status" id="status">
                                            <option value="active" {{$merchant->status === 'active' ? 'selected' : ''}}>Active</option>
                                            <option value="inactive" {{$merchant->status === 'inactive' ? 'selected' : ''}}>Inactive</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="status">Send OTP ?</label>
                                        <select class="form-control form-control-sm" name="isSend" id="isSend">
                                            <option value="yes" {{$merchant->isSend == 'yes' ? 'selected' : ''}}>Yes</option>
                                            <option value="no" {{$merchant->isSend == 'no' ? 'selected' : ''}}>No</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-12 mb-1">
                                        <label for="isReturnCharge">Select Cancel Charge Status</label>

                                        <select class="form-control form-control-sm" name="isReturnCharge" id="isReturnCharge">
                                            <option value="apply" {{$merchant->isReturnCharge == 'apply' ? 'selected' : ''}}>Charge Apply</option>
                                            <option value="not_apply" {{$merchant->isReturnCharge == 'not_apply' ? 'selected' : ''}}>Charge Not Apply</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 col-12 mb-1">
                                            <div class="form-group">
                                                <label for="name">Address Details</label>
                                                <textarea class="form-control form-control-sm" id="label-textarea" rows="3" placeholder="Give full adress">{{$merchant->address}}</textarea>
                                                @if($errors->has('address'))
                                                    <small class="text-danger">{{$errors->first('address')}}</small>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Update Now</button>
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
@section('css')

@endsection
@section('js')

@endsection