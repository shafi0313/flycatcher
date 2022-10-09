@extends('merchant.layouts.master')
@section('title', 'Parcel Request list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('merchant.dashboard'),
            'Parcel request list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel request list' :links="$links"/>
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Parcel Request </h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('merchant.parcel.create')}}"
                                       class="btn btn-primary mr-1">{{__('Add Parcel')}}</a>

                                    <a href="{{route('merchant.parcel.index')}}"
                                       class="btn btn-outline-primary">{{__('View Parcel List')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
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
        $('#dataTable').dataTable({
            stateSave: true,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: '{!! route('merchant.parcel.request.index') !!}',
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
@endpush

