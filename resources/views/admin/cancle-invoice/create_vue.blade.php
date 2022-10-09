@extends('layouts.master')
@section('title','Cancle Invoice')
@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Cancle Invoice</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Cancle Invoice Create
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
                        <a class="dropdown-item" href="{{route('admin.cancle-invoice.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Cancle Invoice Create</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="merchant_id">Merchant</label>
                                        <select class="form-control form-control bSelect" id="merchant_id" name="merchant_id" v-model="merchant_id" @change="fetch_merchant">
                                            <option value="">Select One</option>
                                            @foreach($merchants as $list)
                                            <option value="{{ $list->id }}"> {{ $list->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="added_date">Booking Date</label>
                                        <input type="date" class="form-control input-sm" v-model="added_date" @change="fetch_merchant">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="parcel_id">Parcel</label>
                                        <select class="form-control form-control bSelect" id="parcel_id" name="parcel_id" v-model="parcel_id" @change="fetch_parcel">
                                            <option value="">Select One</option>
                                            <option :value="merchant_parcel.id" v-for="(merchant_parcel, index) in merchant_parcels" :key="index">@{{++index}}. @{{merchant_parcel.invoice_id}} (@{{merchant_parcel.tracking_id}})</option>
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
                        <form action="{{route('admin.cancle-invoice.store')}}" method="POST" class="">
                            @csrf
                            <section class="invoice-preview-wrapper">
                                <div class="row invoice-preview">
                                    <!-- Invoice -->
                                    <div class="col-xl-12 col-md-12 col-12">
                                        <div class="card invoice-preview-card">
                                            <!-- Address and Contact starts -->
                                            <div class="card-body invoice-padding pt-0">
                                                <div class="row invoice-spacing">
                                                    <div class="col-xl-8 p-0">
                                                        <h6 class="mb-2">Invoice To:</h6>
                                                        <h6 class="mb-25">@{{ merchant_info.name }}
                                                            <input type="hidden" name="merchant_id" v-bind:value="merchant_info.id" readonly>
                                                        </h6>
                                                        <p class="card-text mb-25">@{{ merchant_info.company_name }}</p>
                                                        <p class="card-text mb-25">@{{ merchant_info.address }}</p>
                                                        <p class="card-text mb-25">@{{ merchant_info.mobile }}</p>
                                                        <p class="card-text mb-0">@{{ merchant_info.email }}</p>
                                                    </div>
                                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">

                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Address and Contact ends -->

                                            <!-- Invoice Description starts -->
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th class="py-1"></th>
                                                            <th class="py-1">Invoice Id</th>
                                                            <th class="py-1">Tracking Id</th>
                                                            <th class="py-1">Date</th>
                                                            <th class="py-1">Status</th>
                                                            <th class="py-1">Parcel Price</th>
                                                            <th class="py-1">Collection amount</th>
                                                            <th class="py-1">Delivery Charge</th>
                                                            <th class="py-1">Cod</th>
                                                            <th class="py-1">payable</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom" v-for="(parcel,index) in parcelList">
                                                            <td>
                                                                <button type="button" class="btn btn-danger" @click="delete_row(parcel)"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" :name="'items['+index+'][parcel_id]'" class="form-control input-sm" v-bind:value="parcel.parcel_id">
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.invoice_id" readonly>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.tracking_id }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.date }}</p>
                                                            </td>
                                                            <td>
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.status }}</p>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.collection_amount" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.amount" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.delivery_charge" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.cod" readonly>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control input-sm" v-bind:value="parcel.payable" readonly>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="py-1" colspan="5">Total</th>
                                                            <th class="py-1">@{{ totalParcelPrice }}</th>
                                                            <th class="py-1">@{{ totalAmount }}</th>
                                                            <th class="py-1">@{{ totalDc }}</th>
                                                            <th class="py-1">@{{ totalCod }}</th>
                                                            <th class="py-1">@{{ totalPayable }}
                                                                <input type="hidden" class="form-control input-sm" name="total_parcel_price" v-bind:value="totalParcelPrice" readonly>
                                                                <input type="hidden" class="form-control input-sm" name="total_collection_amount" v-bind:value="totalAmount" readonly>
                                                                <input type="hidden" class="form-control input-sm" name="total_delivery_charge" v-bind:value="totalDc" readonly>
                                                                <input type="hidden" class="form-control input-sm" name="total_cod" v-bind:value="totalCod" readonly>
                                                                <input type="hidden" class="form-control input-sm" name="total_payable" v-bind:value="totalPayable" readonly>
                                                            </th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="card-body invoice-padding pb-0">
                                                <div class="row invoice-sales-total-wrapper">
                                                    <div class="col-md-12 order-md-1 order-2 mt-md-0 mt-3">
                                                        <p class="card-text mb-0">
                                                            <span class="font-weight-bold">Invoiced By:</span> <span class="ml-75">@{{invoicedBy}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Invoice Description ends -->

                                            <hr class="invoice-spacing">

                                            <!-- Invoice Note starts -->
                                            <div class="card-body invoice-padding pt-0">
                                                <div class="row">
                                                    <!-- <div class="col-12">
                                                        <span class="font-weight-bold">Note:</span>
                                                        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                                            projects. Thank You!</span>
                                                    </div> -->
                                                    <div class="col-12">
                                                        <button class="btn btn-primary waves-effect waves-float float-right waves-light mt-2" type="submit">Submit</button>
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
                    get_merchant_url: "{{ url('fetch-merchant-info-by-cancle') }}",
                    get_parcel_url: "{{ url('fetch-parcel-by-parcel-id') }}",
                },
                parcel_id: '',
                added_date: '',
                merchant_id: '',
                invoicedBy: '',
                parcelList: [],
                merchant_info: '',
                merchant_parcels: [],

            },
            methods: {
                reload() {
                    let vm = this;
                    let slug = vm.merchant_id;
                    if (slug) {

                        this.fetch_merchant();
                        toastr.success('Reload Successful!', {
                            closeButton: true,
                            progressBar: true,
                        });
                    } else {
                        toastr.warning('Merchant Not Selected', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                },
                fetch_merchant() {
                    let vm = this;
                    let slug = vm.merchant_id;
                    let added_date = vm.added_date;
                    console.log(slug);
                    console.log(added_date);
                    vm.merchant_parcels = [];
                    if (slug) {
                        axios.get(this.config.get_merchant_url + '/' + slug+ '/' + added_date).then(
                            function(response) {
                                details = response.data;
                                console.log(details.merchant_parcels);
                                vm.merchant_info = details.merchant_info;
                                vm.merchant_parcels = details.merchant_parcels;
                                vm.invoicedBy = details.invoicedBy;
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
                                    console.log(parcel.parcel_collection.amount);
                                    vm.parcelList.push({
                                        parcel_id: parcel.id,
                                        tracking_id: parcel.tracking_id,
                                        invoice_id: parcel.invoice_id,
                                        date: parcel.added_date,
                                        status: parcel.status,
                                        collection_amount: parcel.collection_amount,
                                        amount: parcel.parcel_collection.collection_amount,
                                        delivery_charge: parcel.delivery_charge,
                                        cod: parcel.cod,
                                        payable: parcel.payable,
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
            computed: {
                totalParcelPrice: function() {

                    return this.parcelList.reduce(function(totalParcelPrice, parcel) {

                        return totalParcelPrice + parseInt(parcel.collection_amount);
                    }, 0);
                },
                totalAmount: function() {

                    return this.parcelList.reduce(function(totalAmount, parcel) {

                        return totalAmount + parseInt(parcel.amount);
                    }, 0);
                },
                totalPayable: function() {

                    return this.parcelList.reduce(function(totalPayable, parcel) {

                        return totalPayable + parseInt(parcel.payable);
                    }, 0);
                },
                totalCod: function() {

                    return this.parcelList.reduce(function(totalPayable, parcel) {

                        return totalPayable + parseInt(parcel.cod);
                    }, 0);
                },
                totalDc: function() {

                    return this.parcelList.reduce(function(totalPayable, parcel) {

                        return totalPayable + parseInt(parcel.delivery_charge);
                    }, 0);
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