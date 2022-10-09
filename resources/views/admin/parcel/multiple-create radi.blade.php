@extends('layouts.master')
@section('title','Multiple Parcel Create')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Parcel list'=>route('admin.parcel.index'),
                'Multiple parcel create'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Multiple parcel create' :links="$links"/>
        <div class="content-body">
            <form method="post" action="{{route('admin.parcel.multiple.store')}}" class="invoice-repeater">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="merchant_id">Select Merchant</label>
                                        <select class="form-control select2" name="merchant_id" id="merchant_id">
                                            <option value="">Select one</option>
                                            @foreach($merchants as $merchant)
                                                <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('merchant_id'))
                                            <small class="text-danger">{{$errors->first('merchant_id')}}</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="row">
                                        <div data-repeater-list="invoice">
                                            <div data-repeater-item class="repeat">
                                                <div class="row">
                                                    <div class="col-12 d-flex justify-content-between">
                                                       <div>
                                                           <h4>New Parcel</h4>
                                                       </div>
                                                        <div>
                                                            <div class="form-group">
                                                                <button class="btn btn-danger btn-sm" data-repeater-delete type="button">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label>Delivery Location <span style="color: red;">*</span></label>
                                                            <select class="form-control form-control" name="city_type_id" required>
                                                                <option value="">Select One</option>
                                                                @foreach($city_types as $list)
                                                                    <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="area_id">Delivery Area <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="area_id" id="area_id" required>
                                                            <option value="">Select one</option>
                                                        </select>

                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="sub_area_id">Delivery Sub Area <span style="color: red;">*</span></label>
                                                        <select class="form-control" name="sub_area_id" id="sub_area_id" required>
                                                            <option value="">Select one</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="parcel_type_id">Percel Type <span style="color: red;">*</span></label>
                                                        <select class="form-control bSelect" name="parcel_type_id" id="parcel_type_id" class="form-control" required>
                                                            <option value="">Select one</option>
                                                            @foreach($parcel_types as $parcel_type)
                                                                <option value="{{ $parcel_type->id }}">{{ $parcel_type->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                        <div class="form-group col-md-3">
                                                            <label for="weight_range_id">Weight <span style="color: red;">*</span></label>
                                                            <select class="form-control" name="weight_range_id" id="weight_range_id" required>
                                                                <option value="">Select one</option>
                                                                @foreach($weight_ranges as $weight_range)
                                                                    <option value="{{ $weight_range->id }}">{{ $weight_range->min_weight }} - {{ $weight_range->max_weight }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    <div class="form-group col-md-3 required">
                                                        <label class="control-label" for="payment_status">Payment Status <span style="color: red;">*</span></label>
                                                        <select class="form-control bSelect" name="payment_status" id="payment_status" required>
                                                            <option value="">Select one</option>
                                                            <option value="paid">Paid</option>
                                                            <option value="unpaid">Unpaid</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-md-3 ">
                                                        <div class="form-group">
                                                            <label for="collection_amount">Collection Amount <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="collection_amount" name="collection_amount" placeholder="Enter Collection Amount">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3  mb-1">
                                                        <div class="form-group">
                                                            <label for="invoice_id">Invoice Number <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="invoice_id" name="invoice_id" placeholder="Enter Invoice Number" required>
                                                            <input type="hidden"  class="form-control" id="rider_id" name="assigning_by"  required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="customer_name">Customer Name <span style="color: red;">*</span></label>
                                                            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="customer_mobile">Customer Mobile Number <span style="color: red;">*</span></label>
                                                            <!-- <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" placeholder="Enter Customer Mobile" required> -->
                                                            <div class="input-group mb-2">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                                </div>
                                                                <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" placeholder="Enter Customer Mobile" aria-label="Username" aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-1">
                                                        <div class="form-group">
                                                            <label for="customer_alt_mobile">Customer Other Mobile Number</label>
                                                            <!-- <input type="text" class="form-control" id="customer_alt_mobile" name="customer_alt_mobile" placeholder="Enter Other Customer Mobile"> -->
                                                            <div class="input-group mb-2">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                                </div>
                                                                <input type="text" class="form-control" id="customer_alt_mobile" name="customer_alt_mobile" placeholder="Enter Other Customer Mobile" aria-label="Username" aria-describedby="basic-addon1">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mb-1">
                                                        <div class="form-group required">
                                                            <label for="customer_address" class="control-label">Customer Address <span style="color: red;">*</span></label>
                                                            <textarea class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="note">Note</label>
                                                            <textarea class="form-control" id="note" name="note" placeholder="Enter Note" rows="3"></textarea>
                                                            <input type="hidden" class="form-control" id="cod" name="cod" v-model="cod">
                                                            <input type="hidden" class="form-control" id="delivery_charge" name="delivery_charge" v-model="deliverycharge">
                                                        </div>
                                                    </div>

                                                </div>
                                                <hr />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                            <i data-feather="plus" class="mr-25"></i>
                                            <span>Add New</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"> Submit</button>
            </form>
        </div>
    </div>

@endsection

@push('style')
    <link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush

@push('script')
    <script src="{{asset('admin/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
    <script src="{{asset('admin/app-assets/js/scripts/forms/form-repeater.js')}}"></script>
@endpush

