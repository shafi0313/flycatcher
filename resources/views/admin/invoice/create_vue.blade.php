@extends('layouts.master')
@section('title','Invoice')
@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endpush
@section('content')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Invoice</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                            </li>
                            <li class="breadcrumb-item active">Invoice Create
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
                        <a class="dropdown-item" href="{{route('admin.invoice.index')}}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square mr-1">
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
                            <h5 class="card-title">Invoice Create</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="merchant_id">Merchant</label>
                                        <select class="form-control form-control bSelect" id="merchant_id" name="merchant_id" v-model="merchant_id">
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
                                        <input type="date" class="form-control input-sm" v-model="added_date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for=""></label>
                                        <button class="btn btn-primary form-control input-sm" type="button" @click="fetch_invoice_data">Search Parcel</button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="content-body">
                        <form action="{{route('admin.invoice.store')}}" method="POST" class="">
                            @csrf
                            <section class="invoice-preview-wrapper">
                                <div class="row invoice-preview">
                                    <!-- Invoice -->
                                    <div class="col-xl-12 col-md-12 col-12" v-if="parcels.length > 0">
                                        <div class="card invoice-preview-card">
                                            <!-- Address and Contact starts -->
                                            <div class="card-body invoice-padding pt-0">
                                                <div class="row invoice-spacing">
                                                    <div class="col-xl-8 p-0">
                                                        <h6 class="mb-2">Invoice To:</h6>
                                                        <h6 class="mb-25">@{{ merchant_info.name }} <input type="hidden" name="merchant_id" v-bind:value="merchant_info.id" readonly></h6>
                                                        <p class="card-text mb-25">@{{ merchant_info.company_name }}</p>
                                                        <p class="card-text mb-25">@{{ merchant_info.address }}</p>
                                                        <p class="card-text mb-25">@{{ merchant_info.mobile }}</p>
                                                        <p class="card-text mb-0">@{{ merchant_info.email }}</p>
                                                    </div>
                                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                                        <h4 class="text-right justify-content-center align-items-center">
                                                            Total Parcel= @{{ parcels.length }}
                                                        </h4>
                                                        <div class="row justify-content-center">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="payment_method">Payment Method</label>
                                                                    <select class="form-control form-control bSelect" id="payment_method" name="payment_method">
                                                                        <option value="cash">Cash</option>
                                                                        <option value="bank">Bank</option>
                                                                        <option value="bkash">Bkash</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
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
                                                            <th class="py-1">Area</th>
                                                            <th class="py-1">Status</th>
                                                            <!-- <th class="py-1">Mobile</th> -->
                                                            <th class="py-1">Payment Status</th>
                                                            <th class="py-1">Parcel Price</th>
                                                            <th class="py-1">collection amount</th>
                                                            <th class="py-1">Delivery Charge</th>
                                                            <th class="py-1">Cod</th>
                                                            <th class="py-1">Payable</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="border-bottom" v-for="(parcel,index) in parcels">
                                                            <td>
                                                                <button type="button" class="btn btn-danger" @click="delete_row(parcel)"><i class="fa fa-trash"></i></button>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.invoice_id }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.tracking_id }}</p>
                                                                <input type="hidden" :name="'items['+index+'][parcel_id]'" class="form-control input-sm" v-bind:value="parcel.parcel.id">
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.added_date }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.sub_area.name }}</p>
                                                            </td>
                                                            <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.status }}</p>
                                                            </td>
                                                            <!-- <td class="py-1">
                                                                <p class="card-text font-weight-bold mb-25">@{{ parcel.parcel.customer_mobile }}</p>
                                                            </td> -->
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.merchant_paid}}</span>
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.parcel.collection_amount}}</span>
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.collection_amount}}</span>
                                                                <input type="hidden" :name="'items['+index+'][collection_amount]'" class="form-control input-sm" v-bind:value="parcel.collection_amount">
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{ parcel.delivery_charge }}</span>
                                                                <input type="hidden" :name="'items['+index+'][delivery_charge]'" class="form-control input-sm" v-bind:value="parcel.delivery_charge">
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.cod_charge}}</span>
                                                                <input type="hidden" :name="'items['+index+'][cod_charge]'" class="form-control input-sm" v-bind:value="parcel.cod_charge">
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="font-weight-bold">@{{parcel.net_payable}}</span>
                                                                <input type="hidden" :name="'items['+index+'][net_payable]'" class="form-control input-sm" v-bind:value="parcel.net_payable">
                                                                <input type="hidden" :name="'items['+index+'][note]'" class="form-control input-sm" v-bind:value="parcel.note">
                                                            </td>

                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                            <div class="card-body invoice-padding pb-0">
                                                <div class="row invoice-sales-total-wrapper">
                                                    <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                                        <p class="card-text mb-0">
                                                            <span class="font-weight-bold">Invoiced By:</span> <span class="ml-75">@{{invoicedBy}}</span>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                                        <div class="invoice-total-wrapper">
                                                            <div class="invoice-total-item">
                                                                <p class="invoice-total-title">Subtotal:</p>
                                                                <p class="invoice-total-amount">@{{ total }}</p>
                                                                <input type="hidden" class="form-control input-sm" name="total_collection_amount" v-bind:value="total" readonly>
                                                            </div>
                                                            <div class="invoice-total-item">
                                                                <p class="invoice-total-title">Cod:</p>
                                                                <p class="invoice-total-amount">@{{ totalCod }}</p>
                                                                <input type="hidden" class="form-control input-sm" name="total_cod" v-bind:value="totalCod" readonly>
                                                            </div>
                                                            <div class="invoice-total-item">
                                                                <p class="invoice-total-title">Delivery Charge:</p>
                                                                <p class="invoice-total-amount">@{{ totalDc }}</p>
                                                                <input type="hidden" class="form-control input-sm" name="total_delivery_charge" v-bind:value="totalDc" readonly>
                                                            </div>
                                                            <hr class="my-50">
                                                            <div class="invoice-total-item">
                                                                <p class="invoice-total-title">Total:</p>
                                                                <p class="invoice-total-amount">@{{ total - totalDc - totalCod }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Invoice Description ends -->

                                            <hr class="invoice-spacing">

                                            <!-- Invoice Note starts -->
                                            <div class="card-body invoice-padding pt-0">
                                                <div class="row">
                                                    <div class="col-8">
                                                        <span class="font-weight-bold">Note:</span>
                                                        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                                            projects. Thank You!</span>
                                                    </div>
                                                    <div class="col-4">
                                                        <button class="btn btn-success btn-block waves-effect waves-float waves-light float-right" type="submit">Submit</button>
                                                        <!-- <button class="btn btn-primary waves-effect waves-float waves-light float-right  mr-2" type="submit">Save And Print</button> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Invoice Note ends -->
                                        </div>
                                    </div>
                                    <!-- /Invoice -->
                                    <div class="col-xl-12 col-md-12 col-12" v-else>
                                        <div class="card invoice-preview-card">
                                            <div class="card-body pb-10">
                                                <h3 class="text-center">Not Found Parcel</h3>
                                            </div>
                                        </div>

                                    </div>
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
                    get_parcel_url: "{{ url('fetch-merchant-wise-parcel') }}",
                    get_parcel_date_url: "{{ url('fetch-merchant-date-wise-parcel') }}",
                },
                added_date: '',
                merchant_id: '',
                invoicedBy: '',
                parcels: [],
                merchant_info: '',

            },
            methods: {
                delete_row: function(row) {
                    this.parcels.splice(this.parcels.indexOf(row), 1);
                },
                fetch_invoice_data() {
                    let vm = this;
                    let merchant_id = vm.merchant_id;
                    let added_date = vm.added_date;
                    console.log(merchant_id);
                    console.log(added_date);


                    if (merchant_id) {
                        axios.get(this.config.get_parcel_date_url + '/' + merchant_id + '/' + added_date).then(
                            function(response) {
                                details = response.data;
                                vm.parcels = details.unpaid_parcel;
                                vm.merchant_info = details.merchant_info;
                                vm.invoicedBy = details.invoicedBy;
                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    } else {
                        toastr.warning('Merchant Not Selected', {
                            closeButton: true,
                            progressBar: true,
                        });
                    }
                },
                fetch_parcel() {
                    let vm = this;
                    let slug = vm.merchant_id;
                    if (slug) {
                        axios.get(this.config.get_parcel_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                vm.parcels = details.unpaid_parcel;
                                vm.merchant_info = details.merchant_info;
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

            },
            computed: {
                total: function() {

                    return this.parcels.reduce(function(total, parcel) {

                        return total + parseInt(parcel.collection_amount);
                    }, 0);
                },
                totalCod: function() {

                    return this.parcels.reduce(function(total, parcel) {

                        return total + parseInt(parcel.cod_charge);
                    }, 0);
                },
                totalDc: function() {

                    return this.parcels.reduce(function(total, parcel) {

                        return total + parseInt(parcel.delivery_charge);
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