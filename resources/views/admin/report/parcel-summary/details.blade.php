@extends('layouts.master')
@section('title', 'Parcel Summary Details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Parcel Summary'=>route('admin.parcel.summary'),
            'Parcel Summary Details'=>'',
            ]
        @endphp
        <x-bread-crumb-component title='Parcel Summary Details' :links="$links" />
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0">Parcel summary details</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
                                {{-- show from datatable--}}
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
            var table = $('#dataTable').dataTable({
                // stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{route('admin.parcel.summary.details', ['status'=>$status,'start_date'=>$startDate, 'end_date'=>$endDate])}}',
                columns: [
                    {
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
                    // {
                    //     data: "action",
                    //     title: "Action",
                    //     orderable: false,
                    //     searchable: false
                    // },
                    //
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
                        data: "customer_name",
                        "visible": false,
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "customer_mobile",
                        "visible": false,
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "customer_address",
                        "visible": false,
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: "rider.name",
                        "visible": false,
                        orderable: true,
                        searchable: true,
                        "defaultContent": '<i class="text-danger">Not Set</i>'
                    },
                    {
                        data: "rider.rider_code",
                        "visible": false,
                        orderable: true,
                        searchable: true,
                        "defaultContent": '<i class="text-danger">Not Set</i>'
                    },
                ],
            });
        })
    </script>
@endpush

