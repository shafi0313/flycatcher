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
                    <div class="card-body">
                        <div class="head-label table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6>Collection Amount: {{number_format($parcel->collection_amount)}} TK</h6>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form action="{{route('rider.parcel.status.change.store', $parcel->id)}}" method="POST" id="collectionForm">
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="parcel_id" value="{{$parcel->id}}">
                            <div class="form-group">
                                <label for="status">Select a status</label>
                                <select class="form-control form-control-sm" id="status" name="status" onchange="myFunction()">
                                    <option value=" ">Select One</option>
                                    <option value="delivered">Delivered/Cash</option>
                                    <option value="partial">Partial Delivered</option>
                                    <option value="mobileBanking">Mobile Banking</option>
                                    <option value="hold">Hold</option>
                                    <option value="cancelled">Cancel</option>
                                </select>
                            </div>
                            <div class="cancel-box">
                                <div class="form-group cancel_reason">
                                    <label>Select A Cancel Reason: </label>
                                    <select class="form-control form-control-sm" name="cancel_reason">
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
                                    <input type="number" class="form-control form-control-sm" name="cancel_collection" placeholder="Enter collected amount" value="0">

                                    @if($errors->has('cancel_collection'))
                                    <small class="text-danger">{{$errors->first('cancel_collection')}}</small>
                                    @endif
                                </div>
                                <div class="form-group note">
                                    <label>Note: </label>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm" name="cancel_note" placeholder="Cancel Note Here"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Sent Sms: </label>
                                    <div class="form-group d-flex justify-content-center">
                                        <button class="btn btn-sm btn-outline-warning mx-auto" parcel_id="{{$parcel->id}}" type="button" id="btnSend">
                                            OTP Send Merchant
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>OTP: </label>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm" name="otp" placeholder="Enter OTP">
                                    </div>
                                </div>
                            </div>
                            <div class="hold-box hold_reason">
                                <div class="form-group ">
                                    <label>Select A Hold Reason: </label>
                                    <select class="form-control form-control-sm" name="hold_reason">
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
                                        <textarea class="form-control form-control-sm" name="hold_note" placeholder="Hold Note Here"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="partial-delivery-box">
                                <div class="form-group">
                                    <label for="partial_amount">Collected amount</label>
                                    <input type="number" class="form-control form-control-sm" name="partial_amount" placeholder="Enter collected amount">
                                </div>
                                <div class="form-group return_product">
                                    <label for="return_product">Return product</label>
                                    <select class="form-control form-control-sm select2" name="return_product" id="return_product">
                                        @for($i=1; $i<=50; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-group note">
                                    <label>Note: </label>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm" name="note" placeholder="Note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mobile-banking-box">
                                <div class="form-group">
                                    <label for="mobile_banking_id">Mobile banking type</label>
                                    <select class="form-control form-control-sm" name="mobile_banking_id" id="mobile_banking_id">
                                        @foreach($mobileBankings as $mobileBanking)
                                        <option value="{{$mobileBanking->id}}">{{$mobileBanking->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @isset($parcel->merchant->merchant_active_mobile_bankings)
                                <div class="form-group">
                                    <label for="merchant_mobile_banking_id">Merchant Mobile Number</label>
                                    <select class="form-control form-control-sm" name="merchant_mobile_banking_id" id="merchant_mobile_banking_id">
                                        @foreach($parcel->merchant->merchant_active_mobile_bankings as $banking)
                                        <option value="{{$banking->id}}">{{$banking->mobile_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @else
                                @endisset

                                <div class="form-group">
                                    <label for="customer_mobile_number">Customer Mobile Number</label>
                                    <input type="number" class="form-control form-control-sm" name="customer_mobile_number" id="customer_mobile_number" placeholder="Enter customer number">
                                </div>

                                <div class="form-group">
                                    <label for="mobile_partial_amount">Rider Collected Amount</label>
                                    <input type="number" class="form-control form-control-sm" name="mobile_partial_amount" id="mobile_partial_amount" placeholder="Enter collected amount">
                                </div>

                                <div class="form-group">
                                    <label for="mobile_banking_amount">Mobile Banking Amount</label>
                                    <input type="number" class="form-control form-control-sm" name="mobile_banking_amount" id="mobile_banking_amount" placeholder="Mobile Banking Amount">
                                </div>
                                <div class="form-group return_product">
                                    <label for="mobile_return_product">Return product</label>
                                    <select class="form-control form-control-sm select2" name="mobile_return_product" id="mobile_return_product">
                                        @for($i=0; $i<=50; $i++) <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                    </select>
                                </div>
                                <div class="form-group note">
                                    <label for="mobile_note">Note: </label>
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm" name="mobile_note" placeholder="Note" id="mobile_note"></textarea>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect waves-float waves-light" type="submit" id="collectionButton">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
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
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $("#btnSend").click(function() {
            parcel_id = $(this).attr("parcel_id");
            $.ajax({
                url: '/send-sms/' + parcel_id,
                type: 'GET',
                success: function(result) {
                    toastr.success(result.success, {
                        closeButton: true,
                        progressBar: true,
                    });
                }
            });
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.full_delivery_type').hide();
        $('.cancel-box').hide();
        $('.hold_reason').hide();
        $('.partial_amount').hide();
        $('.partial-delivery-box').hide();
        $('.mobile-banking-box').hide();
        $('.hold-box').hide();
    });

    function myFunction() {
        let status = $('#status option:selected').val();
        if (status === 'transit') {
            $('.cancel-box').hide();
            $('.hold_reason').hide();
            $('.partial_amount').hide();
            $('.partial-delivery-box').hide();
            $('.mobile-banking-box').hide();
        }
        if (status === 'delivered') {
            $('.cancel-box').hide();
            $('.hold_reason').hide();
            $('.partial-delivery-box').hide();
            $('.mobile-banking-box').hide();
        }
        if (status === 'partial') {
            $('.cancel-box').hide();
            $('.hold_reason').hide();
            $('.partial-delivery-box').show();
            $('.mobile-banking-box').hide();
        }
        if (status === 'hold') {
            $('.cancel-box').hide();
            $('.hold_reason').show();
            $('.partial-delivery-box').hide();
            $('.mobile-banking-box').hide();
        }
        if (status === 'cancelled') {
            $('.cancel-box').show();
            $('.hold_reason').hide();
            $('.partial-delivery-box').hide();
            $('.mobile-banking-box').hide();
        }
        if (status === 'mobileBanking') {
            $('.cancel-box').hide();
            $('.hold_reason').hide();
            $('.partial-delivery-box').hide();
            $('.mobile-banking-box').show();
        }
    }

    function changeFullDeliveryType() {
        let option = $('.full_delivery_option_select option:selected').val();
        if (option === 'mobile_banking') {
            $('.full_delivery_mobile_banking_info').show();
        } else {
            $('.full_delivery_mobile_banking_info').hide();
        }
    }

    function changePartialDeliveryType() {
        let option = $('.partial_delivery_option_select option:selected').val();
        if (option === 'mobile_banking') {
            $('.partial_delivery_mobile_banking_info').show();
        } else if (option === 'cash_on_delivery') {
            $('.partial_delivery_mobile_banking_info').hide();
        }
    }
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