@extends('layouts.master')
@section('title', 'Sms Settings')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Sms Setting list'=>route('admin.parcel-type.index'),
    'Sms Setting create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Sms Settings' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sms Settings</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sms-settings.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="mobile">Parcelsheba Official Mobile Number</label>
                                            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" value="{{ $smsSetting->mobile??'' }}">
                                            @if($errors->has('mobile'))
                                            <small class="text-danger">{{$errors->first('mobile')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="ofc_send">OTP Office ?</label>
                                            <select class="form-control select2" name="ofc_send" id="ofc_send" required>
                                                <option value="">Select one</option>
                                                @if($smsSetting)
                                                <option value="yes" {{ $smsSetting->ofc_send == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $smsSetting->ofc_send == 'no' ? 'selected' : '' }}>No</option>
                                                @else
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="merchant_send">OTP Merchant ?</label>
                                            <select class="form-control select2" name="merchant_send" id="merchant_send" required>
                                                <option value="">Select one</option>
                                                @if($smsSetting)
                                                <option value="yes" {{ $smsSetting->merchant_send == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $smsSetting->merchant_send == 'no' ? 'selected' : '' }}>No</option>
                                                @else
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_send">OTP Customer ?</label>
                                            <select class="form-control select2" name="customer_send" id="customer_send" required>
                                                <option value="">Select one</option>
                                                @if($smsSetting)
                                                <option value="yes" {{ $smsSetting->customer_send == 'yes' ? 'selected' : '' }}>Yes</option>
                                                <option value="no" {{ $smsSetting->customer_send == 'no' ? 'selected' : '' }}>No</option>
                                                @else
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                                @endif
                                            </select>
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
@section('css')

@endsection
@section('js')

@endsection
