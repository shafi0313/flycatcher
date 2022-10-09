@extends('layouts.master')
@section('title', 'Parcel list')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel list'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Parcel {{str_replace('_', ' ', ucfirst($status))}} list' :links="$links" />
    <div class="content-body" id="">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="head-label">
                            <h4 class="mb-0"> {{str_replace('_', ' ', ucfirst($status))}} Parcel</h4>
                        </div>
                    </div>
                    <div class="card-body statistics-body">
                        <div class="row mb-1">
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index')}}" class="btn btn-block p-0 border border-primary {{$totalParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-primary py-1">
                                                <h5 class="font-weight-bolder mb-0">All</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'pending'])}}" class="btn btn-block p-0 border border-warning {{$totalPendingParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-warning py-1">
                                                <h5 class="font-weight-bolder mb-0">Pending</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalPendingParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'transit'])}}" class="btn btn-block p-0 border border-info {{$totalTransitParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-info py-1">
                                                <h5 class="font-weight-bolder mb-0">Transit</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalTransitParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'partial'])}}" class="btn btn-block p-0 border border-warning {{$totalPartialParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row  text-center mx-0">
                                            <div class="col-6 border-right-warning py-1">
                                                <h5 class="font-weight-bolder mb-0">Partial</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalPartialParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'transfer'])}}" class="btn btn-block p-0 border border-danger {{$totalTransferParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-danger py-1">
                                                <h5 class="font-weight-bolder mb-0">Transfer</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalTransferParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'delivered'])}}" class="btn btn-block p-0 border border-success {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-success py-1">
                                                <h5 class="font-weight-bolder mb-0">Delivered</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalDeliveredParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'exchange'])}}" class="btn btn-block p-0 border border-success {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-success py-1">
                                                <h5 class="font-weight-bolder mb-0">Exchange</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalExchangeParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'cancelled'])}}" class="btn btn-block p-0 border border-danger {{$totalCancelParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-danger py-1">
                                                <h5 class="font-weight-bolder mb-0">Cancelled</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalCancelParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'hold'])}}" class="btn btn-block p-0 border border-warning {{$totalHoldParcel==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-warning py-1">
                                                <h5 class="font-weight-bolder mb-0">Rider Hold</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$totalHoldParcel}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'received_at_office'])}}" class="btn btn-block p-0 border border-warning {{$parcelReceivedAtOffice==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-warning py-1">
                                                <h5 class="font-weight-bolder mb-0">Received At Office</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$parcelReceivedAtOffice}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'hold_accept_by_incharge'])}}" class="btn btn-block p-0 border border-warning {{$holdParcelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-warning py-1">
                                                <h5 class="font-weight-bolder mb-0">Hold In Office</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$holdParcelAcceptByIncharge}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                <a href="{{route('admin.parcel.index',['status'=>'cancel_accept_by_incharge'])}}" class="btn btn-block p-0 border border-info {{$cancelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                    <div class="card-body p-0">
                                        <div class="row text-center mx-0">
                                            <div class="col-6 border-right-info py-1">
                                                <h5 class="font-weight-bolder mb-0">Cancel Accept Incharge</h5>
                                            </div>
                                            <div class="col-6 py-1">
                                                <h5 class="font-weight-bolder mb-0">{{$cancelAcceptByIncharge}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> {{str_replace('_', ' ', ucfirst($status))}} Parcel</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <!-- <a style="margin-right: 5px" href="{{route('admin.parcel.multiple.create')}}" class="btn btn-primary">{{__('Add Multiple Parcel')}}</a> -->
                                <a href="{{route('admin.parcel.create')}}" class="btn btn-primary">{{__('Add Parcel')}}</a>
                            </div>
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
            stateSave: true,
            responsive: true,
            serverSide: true,
            processing: true,
            ajax: '{!! route('admin.parcel.index',['status'=>request('status')]) !!}',
            lengthMenu: [10, 25, 50, 75, 100, 500],
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
                    data: "admin_assign",
                    title: "Assign Option",
                    searchable: false,
                    orderable: false
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