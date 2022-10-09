@extends('layouts.master')
@section('title', 'Collection History')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('rider.dashboard'),
                'Incharge Collection  History'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Incharge Collection History' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Incharge Collection</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table">
                                {{--  show from datatable--}}
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
        $(document).ready(function () {
            $('#dataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('admin.incharge.collection.history') !!}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "parcel.tracking_id", title:"Tracking Id"},
                    {data: "parcel.invoice_id", title:"Invoice Id"},
                    {data: "merchant_info", title:"Merchant Info"},
                    {data: "accountant_info", title:"Accountant Info"},
                    {data: "rider_info", title:"Rider Info"},
                    {data: "amount", title:"Collected Amount (TK)"},
                    {data: "date_and_time", title:"Date & Time"},
                    {data: "incharge_collected_status", title:"Status"},
                    {data: "parcel.merchant.name", "visible":false},
                    {data: "parcel.merchant.mobile", "visible":false},
                ],
            });
        })
    </script>
@endpush

