@extends('layouts.rider')

@section('title', 'Parcel status change')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel list'=>route('admin.parcel.index'),
    'Parcel status change'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel Status Change' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row">

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">Parcel Details</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('rider.parcel.index')}}" class="btn btn-primary">{{__('View Parcel List')}}</a>
                            </div>
                        </div>
                    </div>
                    <form action="{{route('rider.parcel.status.change.store', $parcel->id)}}" method="POST" id="collectionForm">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div id="vue_app">
                                <div class="head-label table-responsive">
                                    <table class="table" style="background-color: cornsilk;">
                                        <tbody>
                                            <tr>
                                                <td colspan="2">
                                                    <h4 class="text-center">Collection Amount: {{number_format($parcel->collection_amount)}} TK</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Tracking Id: {{$parcel->tracking_id}}</p>
                                                </td>
                                                <td>
                                                    <p>Invoice Id: {{$parcel->invoice_id}}</p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <input type="hidden" name="parcel_id" v-model="parcel_id" value="{{$parcel->id}}">
                                <div class="form-group">
                                    <label for="status">Select a status</label>
                                    <select class="form-control bSelect" id="status" name="status" v-model="status" @change="myFunction">
                                        <option value="">Select One</option>
                                        <option value="delivered">Delivered/Cash</option>
                                        <option value="exchange">Exchange Delivered</option>
                                        <option value="partial">Partial Delivered</option>
                                        <option value="mobileBanking">Mobile Banking</option>
                                        <option value="hold">Hold</option>
                                    
                                        <option value="cancelled">Cancel</option>
                                    </select>
                                </div>
                                <div class="cancel-box" v-if="cancel_box">
                                    <div class="form-group cancel_reason">
                                        <label>Select A Cancel Reason: </label>
                                        <select class="form-control" name="cancel_reason" required>
                                            <option value="" selected disabled>Select one</option>
                                            @foreach($cancelReasons as $cancelReason)
                                            <option value="{{$cancelReason->id}}">{{$cancelReason->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('reason_type_id'))
                                        <small class="text-danger">{{$errors->first('reason_type_id')}}</small>
                                        @endif
                                    </div>

                                    <div class="form-group cancel_reason">
                                        <label for="partial_amount">Collected amount: </label>
                                        <input type="number" class="form-control" name="cancel_collection" placeholder="Enter collected amount" value="0">

                                        @if($errors->has('cancel_collection'))
                                        <small class="text-danger">{{$errors->first('cancel_collection')}}</small>
                                        @endif
                                    </div>
                                    @if($parcel->merchant->isSend=='yes')
                                    <div class="form-group">
                                        <label>OTP:
                                            <button class="btn btn-sm btn-outline-info" type="button" id="btnSend" @click="sentFunction">
                                                OTP Send
                                            </button>
                                        </label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" v-model="otp" name="otp" v-bind:class="isValid" placeholder="Enter OTP" required @change="otpVerify">
                                        </div>
                                    </div>
                                    @endif
                                    <div class="form-group note">
                                        <label>Note: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="cancel_note" placeholder="Cancel Note Here" required></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="hold-box hold_reason" v-if="hold_box">
                                    <div class="form-group ">
                                        <label>Select A Hold Reason: </label>
                                        <select class="form-control" name="hold_reason">
                                            <option value="" selected disabled>Select one</option>

                                            @foreach($holdReasons as $holdReason)
                                            <option value="{{$holdReason->id}}">{{$holdReason->name}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('reason_type_id'))
                                        <small class="text-danger">{{$errors->first('reason_type_id')}}</small>
                                        @endif
                                    </div>

                                    <div class="form-group note">
                                        <label>Note: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="hold_note" placeholder="Hold Note Here"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="partial-delivery-box" v-if="partial_delivery_box">
                                    <div class="form-group">
                                        <label for="partial_amount">Collected amount</label>
                                        <input type="number" class="form-control" name="partial_amount" placeholder="Enter collected amount">
                                    </div>
                                    <div class="form-group return_product">
                                        <label for="return_product">Return product</label>
                                        <select class="form-control aaa" name="return_product" id="return_product">
                                            @for($i=1; $i<=50; $i++) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="form-group note">
                                        <label>Note: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="note" placeholder="Note"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="mobile-banking-box" v-if="mobile_banking_box">
                                    <div class="form-group">
                                        <label for="mobile_banking_id">Mobile banking type</label>
                                        <select class="form-control" name="mobile_banking_id" id="mobile_banking_id">
                                            @foreach($mobileBankings as $mobileBanking)
                                            <option value="{{$mobileBanking->id}}">{{$mobileBanking->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    @isset($parcel->merchant->merchant_active_mobile_bankings)
                                    <div class="form-group">
                                        <label for="merchant_mobile_banking_id">Merchant Mobile Number</label>
                                        <select class="form-control" name="merchant_mobile_banking_id" id="merchant_mobile_banking_id">
                                            @foreach($parcel->merchant->merchant_active_mobile_bankings as $banking)
                                            <option value="{{$banking->id}}">{{$banking->mobile_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @else
                                    @endisset

                                    <div class="form-group">
                                        <label for="customer_mobile_number">Customer Mobile Number</label>
                                        <input type="number" class="form-control" name="customer_mobile_number" id="customer_mobile_number" placeholder="Enter customer number">
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile_partial_amount">Rider Collected Amount</label>
                                        <input type="number" class="form-control" name="mobile_partial_amount" id="mobile_partial_amount" placeholder="Enter collected amount">
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile_banking_amount">Mobile Banking Amount</label>
                                        <input type="number" class="form-control" name="mobile_banking_amount" id="mobile_banking_amount" placeholder="Mobile Banking Amount">
                                    </div>
                                    <div class="form-group return_product">
                                        <label for="mobile_return_product">Return product</label>
                                        <select class="form-control select2" name="mobile_return_product" id="mobile_return_product">
                                            @for($i=0; $i<=50; $i++) <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="form-group note">
                                        <label for="mobile_note">Note: </label>
                                        <div class="form-group">
                                            <textarea class="form-control" name="mobile_note" placeholder="Note" id="mobile_note"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit" id="collectionButton">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">Customer Information</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Customer Name: </strong>{{$parcel->customer_name}}</td>
                                    <td><strong>Customer Mobile: </strong> {{$parcel->customer_mobile}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Customer Mobile: </strong> {{$parcel->customer_another_mobile}}</td>
                                    <td><strong>Customer Address: </strong> {{$parcel->customer_address}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">Merchant Information</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong>Merchant name: </strong>
                                        {{$parcel->merchant->name}}
                                    </td>
                                    <td><strong>Company name: </strong>
                                        {{$parcel->merchant->company_name}}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Merchant email: </strong> {{$parcel->merchant->email}}</td>
                                    <td><strong>Merchant mobile: </strong> {{$parcel->merchant->mobile}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- Responsive tables end -->
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



@push('style')
<link rel="stylesheet" href="{{ asset('vue-js/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
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
                    get_sent_sms_url: "{{ url('send-sms') }}",
                    get_otp_verify_url: "{{ url('check-otp') }}",
                },
                full_delivery_type: false,
                partial_delivery_box: false,
                mobile_banking_box: false,
                hold_box: false,
                cancel_box: false,
                status: '',
                otp: '',
                parcel_id: "{{$parcel->id}}",
                isValid: '',
            },
            methods: {
                otpVerify() {
                    let vm = this;
                    let slug = vm.parcel_id;
                    let slug1 = vm.otp;
                    console.log(slug);
                    if (slug) {
                        axios.get(this.config.get_otp_verify_url + '/' + slug + '/' + slug1).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                if (details.status == 1) {
                                    vm.isValid = 'activeClass';
                                } else {
                                    vm.isValid = 'errorClass';
                                }

                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                sentFunction() {
                    let vm = this;
                    let slug = vm.parcel_id;
                    if (slug) {
                        axios.get(this.config.get_sent_sms_url + '/' + slug).then(
                            function(response) {
                                details = response.data;
                                console.log(details);
                                toastr.success(details.success, {
                                    closeButton: true,
                                    progressBar: true,
                                });

                            }).catch(function(error) {
                            toastr.error('Something went to wrong', {
                                closeButton: true,
                                progressBar: true,
                            });
                            return false;
                        });
                    }
                },
                myFunction() {
                    let vm = this;
                    let slug = vm.status;
                    if (slug === 'delivered') {
                        vm.full_delivery_type = true;
                        vm.partial_delivery_box = false;
                        vm.mobile_banking_box = false;
                        vm.hold_box = false;
                        vm.cancel_box = false;
                    }
                    if (slug === 'exchange') {
                        vm.exchange_box = true;
                        vm.partial_delivery_box = false;
                        vm.mobile_banking_box = false;
                        vm.hold_box = false;
                        vm.cancel_box = false;
                    }
                    if (slug === 'partial') {
                        vm.full_delivery_type = false;
                        vm.partial_delivery_box = true;
                        vm.mobile_banking_box = false;
                        vm.hold_box = false;
                        vm.cancel_box = false;
                    }
                    if (slug === 'mobileBanking') {
                        vm.full_delivery_type = false;
                        vm.partial_delivery_box = false;
                        vm.mobile_banking_box = true;
                        vm.hold_box = false;
                        vm.cancel_box = false;
                    }
                    if (slug === 'hold') {
                        vm.full_delivery_type = false;
                        vm.partial_delivery_box = false;
                        vm.mobile_banking_box = false;
                        vm.hold_box = true;
                        vm.cancel_box = false;
                    }
                    if (slug === 'cancelled') {
                        vm.cancel_box = false;
                        vm.full_delivery_type = false;
                        vm.partial_delivery_box = false;
                        vm.mobile_banking_box = false;
                        vm.hold_box = false;
                        vm.cancel_box = true;
                    }
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
<script>
    let form = document.getElementById('collectionForm');
    let submitButton = document.getElementById('collectionButton');


    form.addEventListener('submit', function() {
        submitButton.setAttribute('disabled', 'disabled');
        submitButton.innerHTML = 'Please wait...';
    }, false);
</script>
@endpush