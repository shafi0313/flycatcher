@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Parcel list')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel Request List'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel Request List' :links="$links" />
    <div class="content-body" id="">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">

                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> Parcel Request</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="row">
                            <div class="col-12">
                                <form action="" class="">
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="rider_id">Select Merchant </label>
                                            <select class="form-control select2" name="merchant_id" id="merchant_id">
                                               <option value="">Select One</option>
                                                @foreach($merchants as $merchant)
                                                @if (old('merchant_id')==$merchant->id)
                                                <option value="{{$merchant->id}}" selected>{{$merchant->name}}</option>
                                                @else
                                                <option value="{{$merchant->id}}">{{$merchant->name}}</option>
                                                @endif
                                                @endforeach

                                            </select>
                                            @if($errors->has('merchant_id'))
                                            <small class="text-danger">{{$errors->first('merchant_id')}}</small>
                                            @endif
                                        </div>


                                        <div class="col-md-4 form-group">
                                            <label for="daterange">Range</label>
                                            <input type="text" id="daterange" class="form-control flatpickr-range" name="daterange" placeholder="YYYY-MM-DD to YYYY-MM-DD" />
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="fp-range"></label>
                                            <button class="btn btn-primary waves-effect waves-float waves-light form-control" type="button" id="search_button">Search
                                            </button>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="fp-range"></label>
                                            <button class="btn btn-warning waves-effect waves-float waves-light form-control" onclick="window.location.reload()" type="button" id="refresh_button">Refresh</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="searchResult"></div>
                        <div id="dataTableWrapper">
                            <hr>
                            <div>
                                <strong>Total Collected Amount {{number_format($totalCollectedAmount)}} TK</strong>
                            </div>
                            <table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
<script>
    $('#dataTable').dataTable({
        stateSave: true,
        responsive: true,
        serverSide: true,
        processing: true,
        ajax: '{!! route('admin.parcel.request') !!}',
        columns: [{
                data: "DT_RowIndex",
                title: "SL",
                name: "DT_RowIndex",
                searchable: false,
                orderable: false
            },
            {
                data: "customer_details",
                title: "Customer Details",
                searchable: false,
                orderable: false
            },
            {
                data: "area.area_name",
                "visible": false,
                orderable: true,
                searchable: true,
                "defaultContent": '<i class="text-danger">Area Not Set</i>'
            },
            {
                data: "area.area_code",
                "visible": false,
                orderable: true,
                searchable: true,
                "defaultContent": '<i class="text-danger">Area Not Set</i>'
            },
            {
                data: "merchant.name",
                "visible": false,
                orderable: true,
                searchable: true,
                "defaultContent": '<i class="text-danger">Area Not Set</i>'
            },
            {
                data: "merchant.mobile",
                "visible": false,
                orderable: true,
                searchable: true,
                "defaultContent": '<i class="text-danger">Area Not Set</i>'
            },
            {
                data: "customer_address",
                "visible": false,
                orderable: true,
                searchable: true
            },
            {
                data: "merchant_details",
                title: "Merchant Details",
                searchable: false,
                orderable: false,
                "defaultContent": '<i class="text-danger">Area Not Set</i>'
            },
            {
                data: "tracking_id",
                title: "Tracking ID",
                searchable: true,
                orderable: true
            },
            {
                data: "invoice_id",
                title: "Invoice ID",
                searchable: true,
                orderable: true
            },
            {
                data: "date_time",
                title: "Date & Time",
                searchable: true,
                orderable: true
            },
            {
                data: "payment_details",
                title: "Payment Details",
                searchable: true,
                orderable: true
            },
           
            {
                data: "status",
                title: "Status",
                orderable: false,
                searchable: false
            }, 
            {
                data: "action",
                title: "Action",
                orderable: false,
                searchable: false
            },
        ],
    });
</script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left'
        }, function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            let merchant_id = $('#merchant_id').val();  
            let daterange = $('#daterange').val();
            if (merchant_id == '') {
                alert('Please Select Merchant Right Now');
            } else {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.parcel.request.merchant') }}",
                    data: {
                        merchant_id: merchant_id,
                        status: status,
                        daterange: daterange,
                    },
                    success: function(response) {
                        $('#dataTableWrapper').hide();
                        $("#searchResult").html(response);
                    }

                });
            }
        });
    });
</script>
@endpush