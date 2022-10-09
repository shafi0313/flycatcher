@extends('layouts.rider')
@section('title', 'Parcel list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('rider.dashboard'),
                'Rider Collection  list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Rider Collection list' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Rider Collection</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table-bordered table table-secondary table-striped">
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
                ajax: '{!! route('rider.collection.index') !!}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "parcel.tracking_id", title:"Tracking Id"},
                    {data: "parcel.invoice_id", title:"Invoice Id"},
                    {data: "incharge_info", title:"Incharge info"},
                    {data: "parcel.collection_amount", title:"Original Price (TK)"},
                    {data: "amount", title:"Collected Amount (TK)"},
                    {data: "date_and_time", title:"Date & Time"},
                    {data: "rider_collected_status", title:"Status"},
                ],
            });
        })
    </script>
@endpush

