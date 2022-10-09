@extends('layouts.rider')
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
                            <li class="breadcrumb-item"><a href="{{route('merchant.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Parcel Create
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
                        <a class="dropdown-item" href="{{route('merchant.parcel.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
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
                            <h4 class="card-title">Parcel Create</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('merchant.parcel.store')}}" method="POST" class="">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="city_type_id">Delivery Location</label>
                                        <select class="form-control form-control-sm" id="city_type_id" name="city_type_id" v-model="city_type_id" @change="fetch_area()">
                                            <option value="">Select One</option>
                                            @foreach($city_types as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="area_id">Delivery Area</label>

                                        <select class="form-control form-control-sm" name="area_id" id="area_id" class="form-control">
                                            <option value="">Select one</option>
                                            <option :value="row.id" v-for="row in areas" v-html="row.area_name">
                                            </option>
                                        </select>

                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="parcel_type_id">Percel Type</label>
                                        <select class="form-control form-control-sm" name="parcel_type_id" id="parcel_type_id" class="form-control">
                                            <option value="">Select one</option>
                                            @foreach($parcel_types as $parcel_type)
                                            <option value="{{ $parcel_type->id }}">{{ $parcel_type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="weight_range_id">Weight</label>
                                            <select class="form-control form-control-sm" name="weight_range_id" id="weight_range_id" class="form-control" v-model="weight_range_id" @change="fetch_delivey_cod">
                                                <option value="">Select one</option>
                                                @foreach($weight_ranges as $weight_range)
                                                <option value="{{ $weight_range->id }}">{{ $weight_range->min_weight }} - {{ $weight_range->max_weight }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="collection_amount">Collection Amount</label>
                                            <input type="text" class="form-control form-control-sm" id="collection_amount" name="collection_amount" v-model="collection_amount" placeholder="Collection Amount" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="payment_status">Payment Status</label>

                                        <select class="form-control form-control-sm" name="payment_status" id="payment_status" class="form-control" v-model="area_id" @change="fetch_Parcel()">
                                            <option value="">Select one</option>
                                            <option value="Paid">Paid</option>
                                            <option value="Unpaid">Unpaid</option>

                                        </select>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_name">Customer Name</label>
                                            <input type="text" class="form-control form-control-sm" id="customer_name" name="customer_name" placeholder="Enter Customer Name">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_mobile">Customer Mobile Number</label>
                                            <input type="text" class="form-control form-control-sm" id="customer_mobile" name="customer_mobile" placeholder="Enter Customer Mobile">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="customer_address">Customer Address</label>
                                            <input type="text" class="form-control form-control-sm" id="customer_address" name="customer_address" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-xl-4 col-md-4 col-12 mb-1">
                                        <div class="form-group">
                                            <label for="note">Note</label>
                                            <input type="text" class="form-control form-control-sm" id="note" name="note" placeholder="Enter Note">
                                            <input type="hidden" class="form-control form-control-sm" id="cod" name="cod" v-model="cod">
                                            <input type="hidden" class="form-control form-control-sm" id="delivery_charge" name="delivery_charge" v-model="deliverycharge">
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-primary waves-effect waves-float waves-light" type="submit">Submit</button>
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
@section('css')

@endsection
@section('js')

@endsection
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
                    get_area_url: "{{ url('fetch-area-by-city-type-id') }}",
                    get_delivery_cod_url: "{{ url('fetch-delivery-cod-charge') }}",
                },
                city_type_id: '',
                weight_range_id: '',
                collection_amount: 0,
                deliverycharge: 0,
                cod: 0,
                area_id: '',
                areas: [],

            },
            methods: {
                fetch_area() {
                    let vm = this;
                    let slug = vm.city_type_id;
                    if (slug) {
                        axios.get(this.config.get_area_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                // console.log(details);
                                vm.areas = details.areas;
                                vm.weight_range_id = '';
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
                    if (slug) {
                        axios.get(this.config.get_delivery_cod_url + '/' + slug + '/' + slug1).then(
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
        });
    });
</script>
@endpush
