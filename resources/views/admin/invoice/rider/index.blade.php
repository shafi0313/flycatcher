@extends('layouts.master')
@section('title', 'Rider Invoice list')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Invoice list'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Rider Invoice List' :links="$links" />
    <div class="content-body" id="">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">

                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> Invoice</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
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

        $('#dataTable').dataTable({
            stateSave: true,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: '{!! route('admin.rider.invoice.index') !!}',
            columns: [{
                    data: "DT_RowIndex",
                    title: "SL",
                    name: "DT_RowIndex",
                    searchable: false,
                    orderable: false
                },
                {
                    data: "rider_info",
                    title: "Rider Info",
                },
                {
                    data: "invoice_number",
                    title: "Invoice Number",
                },
                {
                    data: "date_and_time",
                    title: "Date & Time",
                    searchable: false,
                    orderable: false
                },
                {
                    data: "total_collection_amount",
                    title: "Total Collection Amount (TK)",
                    searchable: true,
                    orderable: true
                },
                {
                    data: "total_cod",
                    title: "Total Cod (TK)",
                    searchable: true,
                    orderable: true
                },
                {
                    data: "total_delivery_charge",
                    title: "Total Delivery Charge (TK)",
                    searchable: true,
                    orderable: true
                },
                {
                    data: "action",
                    title: "Action",
                    searchable: true,
                    orderable: true
                },
                {
                    data: "invoice.name",
                    "visible": false,
                    searchable: true,
                    "defaultContent": '<i class="text-danger">Not Set</i>'
                },
                {
                    data: "invoice.mobile",
                    "visible": false,
                    searchable: true,
                    "defaultContent": '<i class="text-danger">Not Set</i>'
                },

            ],
        });
    })
</script>
@endpush