@extends('layouts.rider')
@section('title', 'Invoice list')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('rider.dashboard'),
    'Invoice list'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Invoice list' :links="$links" />
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
                        <table id="dataTable" class="datatables-basic table-bordered table table-striped table-secondary">
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
            ajax: '{!! route('rider.invoices.index') !!}',
            columns: [{
                    data: "DT_RowIndex",
                    title: "SL",
                    name: "DT_RowIndex",
                    searchable: false,
                    orderable: false
                },
                {
                    data: "incharge_info",
                    title: "Incharge Info",
                    "defaultContent": '<i class="text-danger">Area Not Set</i>'
                },
                {
                    data: "invoice_number",
                    title: "Invoice Number",
                },
                {
                    data: "date_time",
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
                    data: "prepare_for.name",
                    "visible": false,
                    searchable: true,
                    "defaultContent": '<i class="text-danger">Area Not Set</i>'
                },
                {
                    data: "prepare_for.mobile",
                    "visible": false,
                    searchable: true,
                    "defaultContent": '<i class="text-danger">Area Not Set</i>'
                },

            ],
        });
    })
</script>
@endpush
