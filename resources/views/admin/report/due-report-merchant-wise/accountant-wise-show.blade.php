@extends('layouts.master')
@section('title', 'Parcel list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Due details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Due Details' :links="$links" />
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Due Details for {{ucfirst($admin->name)}}</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-bordered">
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
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{{route('admin.merchant-wise-due.account.show', ['accountant_id'=>$admin->id, 'merchant_id'=>$merchant_id, 'date_range'=>$date_range])}}',
                columns: [
                    {
                        data: "DT_RowIndex",
                        title: "SL",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "tracking_id",
                        title: "Tracking ID",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "parcel.invoice_id",
                        title: "Invoice ID",
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: "parcel.collection_amount",
                        title: "Parcel Price (TK)",
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: "parcel.delivery_charge",
                        title: "Delivery Charge (TK)",
                        searchable: false,
                        orderable: false
                    },

                    {
                        data: "parcel.cod",
                        title: "COD charge (TK)",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "amount",
                        title: "Collected Amount (TK)",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "delivery_charge",
                        title: "Collected Delivery Charge (TK)",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "cod_charge",
                        title: "Collected COD Charge (TK)",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "parcel_status",
                        title: "Parcel Status",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "is_paid",
                        title: "Is Paid",
                        searchable: false,
                        orderable: false
                    },
                ],
            });
        })
    </script>
@endpush

