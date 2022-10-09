@extends('layouts.master')
@section('title','Search Parcel')
@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Search Parcel</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Search Parcel Create
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row" id="vue_app">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="head-label">
                                <h4 class="mb-0">Search Parcel</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{ url('admin/print-parcels/create') }}" class="btn btn-info waves-effect waves-float waves-light">Goto Print Parcel</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="rider_id">Riders</label>
                                        <select class="form-control form-control bSelect" id="rider_id" name="rider_id" v-model="rider_id" @change="fetch_rider_parcel">
                                            <option value="">Select One</option>
                                            @foreach($riders as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="status">Status</label>
                                        <select class="form-control form-control bSelect" id="status" name="status" v-model="status" @change="fetch_rider_status_parcel">
                                            <option value="">Select One</option>
                                            <option value="pending">Pending</option>
                                            <option value="transit">Transit</option>
                                            <option value="delivered">Delivered/Cash</option>
                                            <option value="partial">Partial</option>
                                            <option value="hold">Hold</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parcel_id">Parcel</label>
                                        <select class="form-control form-control bSelect" id="parcel_id" name="parcel_id" v-model="parcel_id" @change="fetch_parcel">
                                            <option value="">Select One</option>
                                            <option :value="search_parcel.id" v-for="(search_parcel, index) in searchParcelList" :key="index">@{{ ++index}}. @{{search_parcel.invoice_id}} (@{{search_parcel.tracking_id}})</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button class="btn btn-secondary btn-block" type="button" @click="reload">Reload</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="content-body">
                        <form action="{{route('admin.search-parcel.pdf')}}" method="POST" class="" target="_blank">
                            @csrf
                            <section class="">
                                <div class="row">
                                    <!-- Invoice -->
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="card">
                                            <!-- Address and Contact starts -->
                                            <div class="card-body" style="background-color: wheat;">

                                                <div class="row">
                                                    <div class="col-xl-3 p-0">
                                                        <h6 class="mb-25 pl-2"><b>Name:</b> @{{ rider_info.name }}
                                                            <input type="hidden" name="rider_id" v-bind:value="rider_info.id" readonly>
                                                        </h6>
                                                    </div>
                                                    <div class="col-xl-3 p-0">
                                                        <p class="card-text mb-25"><b>Mobile: </b>@{{ rider_info.mobile }}</p>
                                                    </div>
                                                    <div class="col-xl-3 p-0">
                                                        <p class="card-text mb-0"><b>Email:</b> @{{ rider_info.email }}</p>
                                                    </div>
                                                    <div class="col-xl-3 p-0">
                                                        <p class="card-text mb-25"><b>Address:</b> @{{ rider_info.present_address }}</p>
                                                    </div>

                                                </div>
                                            </div>
                                            <!-- Address and Contact ends -->

                                            <!-- Invoice Description starts -->
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th style="padding: 2px!important;"></th>
                                                            <th class="py-1"></th>
                                                            <th class="py-1">CUSTOMER DETAILS</th>
                                                            <th class="py-1">MERCHANT DETAILS</th>
                                                            <th class="py-1">Tracking Id</th>
                                                            <th class="py-1">Invoice Id</th>
                                                            <th class="py-1">Parcel Price</th>
                                                            <th class="py-1">Date</th>
                                                            <th class="py-1">Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom" v-for="(parcel,index) in parcelList">
                                                            <td style="padding: 2px!important;">
                                                                <span>@{{ ++index}}.</span>
                                                            </td>
                                                            <td>
                                                                <button type="button" class="btn btn-danger" @click="delete_row(parcel)"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" :name="'parcelIds[]'" class="form-control input-sm" v-bind:value="parcel.parcel_id">
                                                                <p class="card-text font-weight-bold mb-25"><b>Name:</b> @{{ parcel.customer_name }}</p>
                                                                <p class="card-text font-weight-bold mb-25"><b>Mobile:</b> @{{ parcel.customer_mobile }}</p>
                                                                <p class="card-text font-weight-bold mb-25"><b>Address:</b> @{{ parcel.customer_address }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25"><b>Name:</b> @{{ parcel.merchant_name }}</p>
                                                                <p class="card-text font-weight-bold mb-25"><b>Mobile:</b> @{{ parcel.merchant_mobile }}</p>
                                                                <p class="card-text font-weight-bold mb-25"><b>Address:</b> @{{ parcel.merchant_address }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.tracking_id }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.invoice_id }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.collection_amount }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.date }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25"><span class="badge badge-info">@{{ parcel.status }}</span></p>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- Invoice Note starts -->
                                            <div class="card-body invoice-padding pt-0">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary waves-effect waves-float float-right waves-light mt-2" type="submit" v-if="parcelList.length > 0">Print Here</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Invoice Note ends -->
                                        </div>
                                    </div>
                                    <!-- /Invoice -->
                                </div>
                            </section>
                        </form>
                    </div>
                </div>

            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>
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
                    get_rider_parcel_url: "{{ url('fetch-rider-parcel-by-rider') }}",
                    get_rider_status_parcel_url: "{{ url('fetch-rider-status-parcel-by-rider') }}",
                    get_parcel_url: "{{ url('fetch-rider-parcel-by-parcel-id') }}",
                },
                parcel_id: '',
                rider_id: '',
                status: '',
                searchParcelList: [],
                rider_info: '',
                parcelList: [],

            },
            methods: {
                reload() {
                    let vm = this;
                    let slug = vm.rider_id;
                    if (slug) {

                        this.fetch_rider_parcel();
                        this.fetch_rider_status_parcel();
                        toastr.success('Reload Successful!', {
                            closeButton: true,
                            progressBar: true,
                        });
                    } else {
                        toastr.warning('Rider Not Selected', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                },
                fetch_rider_parcel() {
                    let vm = this;
                    let slug = vm.rider_id;
                    vm.status= '';
                    if (slug) {
                        axios.get(this.config.get_rider_parcel_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details.parcelList);
                                vm.rider_info = details.rider_info;
                                vm.searchParcelList = details.parcelList;
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_rider_status_parcel() {
                    let vm = this;
                    let slug = vm.rider_id;
                    let status = vm.status;
                    if (slug) {
                        axios.get(this.config.get_rider_status_parcel_url + '/' + slug + '/' + status).then(
                            function(response) {
                                details = response.data;
                                console.log(details.parcelList);
                                vm.searchParcelList = [];
                                vm.rider_info = details.rider_info;
                                vm.searchParcelList = details.parcelList;
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                fetch_parcel() {
                    let vm = this;
                    let slug = vm.parcel_id;
                    var exists = vm.parcelList.some(function(field) {
                        return field.parcel_id === vm.parcel_id
                    });
                    if (exists) {
                        toastr.info('Parcel Already Selected', {
                            closeButton: true,
                            progressBar: true,
                        });
                    } else {
                        if (slug) {
                            axios.get(this.config.get_parcel_url + '/' + slug).then(
                                function(response) {
                                    parcel = response.data;
                                    console.log(parcel.status);
                                    vm.parcelList.push({
                                        parcel_id: parcel.id,
                                        tracking_id: parcel.tracking_id,
                                        invoice_id: parcel.invoice_id,
                                        date: parcel.added_date,
                                        collection_amount: parcel.collection_amount,
                                        merchant_name: parcel.merchant.company_name,
                                        merchant_mobile: parcel.merchant.mobile,
                                        merchant_address: parcel.merchant.address,
                                        customer_name: parcel.customer_name,
                                        customer_mobile: parcel.customer_mobile,
                                        customer_address: parcel.customer_address,
                                        status: parcel.status,
                                    });
                                    vm.parcel_id = '';
                                    // console.log(vm.parcelList);
                                }).catch(function(error) {
                                toastr.error('Something went to wrong', {
                                    closeButton: true,
                                    progressBar: true,
                                });
                                return false;
                            });
                        }
                    }
                },
                delete_row: function(row) {

                    this.parcelList.splice(this.parcelList.indexOf(row), 1);
                    // alert(this.parcels.splice(this.parcels.indexOf(row), 1));
                },
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