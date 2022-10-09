@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('admin/app-assets/css/daterangepicker.css') }}">
@endpush
@section('title', 'Merchant Wise Parcel')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home' => route('admin.dashboard'),
    'Parcel' => route('admin.parcel.index'),
    'Merchant Wise Parcel' => '',
    ];
    @endphp
    <x-bread-crumb-component title='Merchant Wise Parcel' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Merchant Wise Parcel</h4>
                        </div>
                        <div class="card-body">
                            <form action="" class="">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label for="merchant_id">Select Merchant </label>
                                        <select class="form-control select2" name="merchant_id" id="merchant_id">
                                            <option value="">Select One</option>
                                            @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('merchant_id'))
                                        <small class="text-danger">{{ $errors->first('merchant_id') }}</small>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="rider_id">Select Rider </label>
                                        <select class="form-control select2" name="rider_id" id="rider_id">
                                            <option value="">Select One</option>
                                            @foreach ($riders as $rider)
                                            <option value="{{ $rider->id }}">{{ $rider->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('rider_id'))
                                        <small class="text-danger">{{ $errors->first('rider_id') }}</small>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="area_id">Select Area </label>
                                        <select class="form-control select2" name="area_id" id="area_id">
                                            <option value="">Select One</option>
                                            @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->area_name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('area_id'))
                                        <small class="text-danger">{{ $errors->first('area_id') }}</small>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="status">Select Status</label>
                                        <select class="form-control select2" name="status" id="status">
                                            <option value="0" selected>All</option>
                                            <option value="pending">Pending</option>
                                            <option value="transit">Transit</option>
                                            <option value="delivered">Delivered/Cash</option>
                                            <option value="partial">Partial</option>
                                            <option value="hold">Hold</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                        @if ($errors->has('status'))
                                        <small class="text-danger">{{ $errors->first('status') }}</small>
                                        @endif

                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="payment_status">Select Payment Status</label>
                                        <select class="form-control select2" name="payment_status" id="payment_status">
                                            <option value="0" selected>All</option>
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                            <option value="received">Received</option>
                                            {{-- <option value="paid">Not Collection</option> --}}
                                        </select>
                                        @if ($errors->has('payment_status'))
                                        <small class="text-danger">{{ $errors->first('payment_status') }}</small>
                                        @endif

                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="daterange">Range</label>
                                        <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                    </div>
                                    <div class="col-md-6 form-group"></div>
                                    <div class="col-md-3 form-group">
                                        <label for="fp-range"></label>
                                        <button class="btn btn-success waves-effect waves-float waves-light form-control" type="button" id="search_button"><i data-feather='search'></i> Search</button>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="fp-range"></label>
                                        <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="button" onclick="location.reload();"><i data-feather='refresh-cw'></i> Refresh</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div id="searchResult"></div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

@push('script')
<script src="{{ asset('admin/app-assets/js/moment.min.js') }}"></script>
<script src="{{ asset('admin/app-assets/js/daterangepicker.js') }}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end
                .format('YYYY-MM-DD'));
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            let merchant_id = $('#merchant_id').val();
            let status = $('#status').val();
            let daterange = $('#daterange').val();
            let payment_status = $('#payment_status').val();
            if (merchant_id == '') {
                alert('Please Select Merchant Right Now');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.merchant-wise-parcel-search') }}",
                    data: {
                        merchant_id: merchant_id,
                        status: status,
                        daterange: daterange,
                        payment_status: payment_status,
                    },
                    success: function(response) {
                        $("#searchResult").html(response);
                    }

                });
            }
        });
    });
</script>
@endpush