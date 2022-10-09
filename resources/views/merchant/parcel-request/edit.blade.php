@extends('merchant.layouts.master')
@section('title','Parcel')
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Parcel</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Parcel Edit
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
            <div class="form-group breadcrumb-right">
                <div class="dropdown">
                    <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle waves-effect waves-float waves-light" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg></button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{route('admin.parcel.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
                                <polyline points="9 11 12 14 22 4"></polyline>
                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                            </svg><span class="align-middle">List</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row" id="vue_app">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Parcel Edit</h4>
                        </div>
                        <div class="card-body">
                            <p style="font-style: italic;font-size:12px">It is obligatory to fill in the fields marked with ( <span style="color: red;">*</span> ). </p>
                            <form action="{{route('merchant.parcel.request.update',$parcel->id)}}" method="POST" class="">
                                @method('put')
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="merchant_id">Merchant <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" id="merchant_id" name="merchant_id" v-model="merchant_id" required>
                                            <option value="">Select One</option>
                                            @foreach($merchants as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="city_type_id">Delivery Location <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" id="city_type_id" name="city_type_id" v-model="city_type_id" @change="fetch_area()" required>
                                            <option value="">Select One</option>
                                            @foreach($city_types as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="area_id">Delivery Area <span style="color: red;">*</span></label>

                                        <select class="form-control bSelect" name="area_id" id="area_id" v-model="area_id" @change="fetch_sub_area()" class="form-control" required>
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in areas" v-html="row.area_name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="sub_area_id">Delivery Sub Area <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="sub_area_id" id="sub_area_id" v-model="sub_area_id" @change="fetch_rider()" class="form-control" required>
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in sub_areas" v-html="row.name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="parcel_type_id">Percel Type <span style="color: red;">*</span></label>
                                        <select class="form-control bSelect" name="parcel_type_id" id="parcel_type_id" class="form-control" required>
                                            <option value="">Select one</option>
                                            @foreach($parcel_types as $parcel_type)
                                            <option value="{{ $parcel_type->id }}" selected ="@if($parcel_type->id==$parcel->parcel_type_id){'selected'}else{''} @endif">{{ $parcel_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="weight_range_id">Weight <span style="color: red;">*</span></label>
                                            <select class="form-control bSelect" name="weight_range_id" id="weight_range_id" class="form-control" v-model="weight_range_id" @change="fetch_delivey_cod" required>
                                                <option value="">Select one</option>
                                                @foreach($weight_ranges as $weight_range)
                                                <option value="{{ $weight_range->id }}">{{ $weight_range->min_weight }} - {{ $weight_range->max_weight }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="invoice_id">Invoice Number <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="invoice_id" name="invoice_id" value="{{$parcel->invoice_id}}" placeholder="Enter Invoice Number" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="collection_amount">Collection Amount <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="collection_amount" name="collection_amount" v-model="collection_amount" placeholder="Collection Amount" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name <span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="customer_name" value="{{$parcel->customer_name}}" name="customer_name" placeholder="Enter Customer Name" required>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_mobile">Customer Mobile Number <span style="color: red;">*</span></label>
                                            <!-- <input type="text" class="form-control" id="customer_mobile" name="customer_mobile" placeholder="Enter Customer Mobile" required> -->
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                </div>
                                                <input type="text" class="form-control " v-bind:class="isValid" id="customer_mobile" v-model="customer_mobile" @keyup="valid_mobile_nunber()" value="{{$parcel->customer_mobile}}" name="customer_mobile" placeholder="Enter Customer Mobile" aria-label="Username" aria-describedby="basic-addon1" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_alt_mobile">Customer Other Mobile Number</label>
                                            <!-- <input type="text" class="form-control" id="customer_alt_mobile" name="customer_alt_mobile" placeholder="Enter Other Customer Mobile"> -->
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1">+88</span>
                                                </div>
                                                <input type="text" class="form-control"  id="customer_alt_mobile" name="customer_alt_mobile" value="{{$parcel->customer_alt_mobile}}" placeholder="Enter Other Customer Mobile" aria-label="Username" aria-describedby="basic-addon1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group required">
                                            <label for="customer_address" class="control-label">Customer Address <span style="color: red;">*</span></label>
                                            <textarea class="form-control" id="customer_address" name="customer_address" placeholder="Enter Address" rows="3" required>{{$parcel->customer_address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-xl-6 col-md-6 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <textarea class="form-control" id="note" name="note" placeholder="Enter Note" rows="3">{{$parcel->note}}</textarea>
                                            <input type="hidden" class="form-control" id="cod" name="cod" v-model="cod">
                                            <input type="hidden" class="form-control" id="delivery_charge" name="delivery_charge" v-model="deliverycharge">
                                            <input type="hidden" v-model="rider_id" class="form-control" id="rider_id" name="assigning_by" required>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light float-right" type="submit">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Delivery Charge Details</h4>
                        </div>
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-8">
                                    <p>Cash Collection</p>
                                </div>
                                <div class="col-sm-4">
                                    <p style="text-align: right;"> @{{ collection_amount }} Tk</p>
                                </div>
                            </div>
                            <!-- row end -->
                            <div class="row">
                                <div class="col-sm-8">
                                    <p>Delivery Charge</p>
                                </div>
                                <div class="col-sm-4">

                                    <p style="text-align: right;"> @{{ deliverycharge }} Tk</p>
                                </div>
                            </div>
                            <!-- row end -->
                            <div class="row">
                                <div class="col-sm-8">
                                    <p>Cod Charge( @{{parseInt(cod) }} %)</p>
                                </div>
                                <div class="col-sm-4">
                                    <p style="text-align: right;"> @{{parseInt(collection_amount) * parseInt(cod) /100  }} Tk</p>
                                    <!-- <p><span v-html="cod"> 0 </span> Tk </p> -->
                                </div>
                            </div>
                            <!-- row end -->
                            <div class="row total-bar" style="border-top: 1px solid #ddd; padding-top:5px;">
                                <div class="col-sm-8">
                                    <p>Total Payable Amount</p>
                                </div>
                                <div class="col-sm-4">
                                    <p style="text-align: right;"> @{{parseInt(collection_amount) - parseInt(deliverycharge)-parseInt(collection_amount) * parseInt(cod) /100  }} Tk</p>
                                </div>
                            </div>
                            <!-- row end -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center">Note : <span class="">If you pick up a request after 7pm ,It will be received the next day</span></p>
                                </div>
                            </div>
                            <!-- row end -->

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
<style>
    .activeClass {
        border: 3px solid green !important;
    }

    .errorClass {
        border: 3px solid red !important;
    }
</style>
@endpush
@push('script')
<script src="{{ asset('vue-js/vue/dist/vue.js') }}"></script>
<script src="{{ asset('vue-js/axios/dist/axios.min.js') }}"></script>
<script src="{{ asset('vue-js/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script>
    //  console.log('error');
    $(document).ready(function() {
        let vue = new Vue({
            el: '#vue_app',
            data: {
                config: {
                    get_rider_url: "{{ url('fetch-rider-by-sub-area-id') }}",
                    get_sub_area_url: "{{ url('fetch-sub-area-by-area-id') }}",
                    get_area_url: "{{ url('fetch-area-by-city-type-id') }}",
                    get_delivery_cod_url: "{{ url('fetch-delivery-cod-charge') }}",
                },
                merchant_id:"{{ $parcel->merchant_id }}",
                city_type_id: "{{ $parcel->city_type_id }}",
                weight_range_id: "{{ $parcel->weight_range_id }}",
                collection_amount: "{{ $parcel->collection_amount }}",
                deliverycharge: "{{ $parcel->delivery_charge }}",
                cod: "{{ $parcel->cod }}",
                rider_id: '',
                isValid: '',
                area_id: "{{ $parcel->area_id }}",
                areas: [],
                sub_area_id: "{{ $parcel->sub_area_id }}",
                customer_mobile: "{{ $parcel->customer_mobile }}",
                sub_areas: [],

            },
            methods: {
                valid_mobile_nunber() {
                    let vm = this;
                    let mobile = vm.customer_mobile;
                    if (mobile.length == 11) {
                        vm.isValid = 'activeClass';
                    } else {
                        vm.isValid = 'errorClass';
                    }
                },
                fetch_sub_area() {
                    let vm = this;
                    let slug = vm.area_id;
                    if (slug) {
                        axios.get(this.config.get_sub_area_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.sub_areas = details.sub_areas;
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_rider() {
                    let vm = this;
                    let slug = vm.sub_area_id;

                    if (slug) {
                        axios.get(this.config.get_rider_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                vm.rider_id = details.rider_id;
                                console.log(rider_id);
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_area() {
                    let vm = this;
                    let slug = vm.city_type_id;
                    if (slug) {
                        axios.get(this.config.get_area_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                // console.log(details);
                                vm.areas = details.areas;
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_delivey_cod() {
                    let vm = this;
                    let slug = vm.city_type_id;
                    let slug1 = vm.weight_range_id;
                    let merchant_id = vm.merchant_id;
                    if (slug) {
                        axios.get(this.config.get_delivery_cod_url + '/' + slug + '/' + slug1 + '/' + merchant_id).then(
                            function(response) {
                                details = response.data;
                                vm.deliverycharge = details.delivery_cod.delivery_charge;
                                vm.cod = details.delivery_cod.cod;
                                //  console.log(details.delivery_cod.cod);
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },

            },
            beforeMount() {
                    this.fetch_area();
                    this.fetch_sub_area();
                    this.fetch_rider();
                },
            updated() {
                $('.bSelect').selectpicker('refresh');
            }
        });
        $('.bSelect').selectpicker({
            liveSearch: true,
            size: 5
        });
    });
</script>
@endpush