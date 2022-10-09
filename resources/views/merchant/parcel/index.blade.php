@extends('merchant.layouts.master')
@section('title', 'Parcel list')

@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Parcel list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel {{str_replace('_', ' ',ucfirst($status))}} list' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> {{str_replace('_', ' ',ucfirst($status))}} Parcel</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('merchant.parcel.create')}}"
                                       class="btn btn-primary">{{__('Add Parcel')}}</a>
                                    <a href="{{route('merchant.parcel.request.index')}}"
                                       class="btn btn-outline-warning ml-1">{{__('View Parcel Request')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body statistics-body">
                            <div class="row mb-1">
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index')}}" class="btn btn-block p-0 border border-primary {{$totalParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0" >
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
                                    <a href="{{route('merchant.parcel.index', ['status'=>'wait_for_pickup'])}}" class="btn btn-block p-0 border border-primary {{$pickupRequest==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0" >
                                                <div class="col-6 border-right-primary py-1">
                                                    <h5 class="font-weight-bolder mb-0">Pickup Request</h5>
                                                </div>
                                                <div class="col-6 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$pickupRequest}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'pending'])}}"  class="btn btn-block p-0 border border-warning {{$totalPendingParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
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
                                    <a href="{{route('merchant.parcel.index',['status'=>'transit'])}}" class="btn btn-block p-0 border border-info {{$totalTransitParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
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
                            </div>
                            <div class="row mb-1">
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'partial'])}}" class="btn btn-block p-0 border border-warning {{$totalPartialParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row  text-center mx-0">
                                                <div class="col-8 border-right-warning py-1">
                                                    <h5 class="font-weight-bolder mb-0">Partial</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalPartialParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'delivered'])}}" class="btn btn-block p-0 border border-success {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
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
                                    <a href="{{route('merchant.parcel.index',['status'=>'cancelled'])}}"
                                       class="btn btn-block p-0 border border-danger {{$totalCancelParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0">
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-danger py-1">
                                                    <h5 class="font-weight-bolder mb-0">Cancelled</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalCancelParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'hold'])}}" class="btn btn-block p-0 border border-warning {{$totalHoldParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
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
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'hold_accept_by_incharge'])}}" class="btn btn-block p-0 border border-warning {{$holdParcelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-6 border-right-warning py-1">
                                                    <h5 class="font-weight-bolder mb-0">Hold Parcel In Office</h5>
                                                </div>
                                                <div class="col-6 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$holdParcelAcceptByIncharge}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'cancel_accept_by_incharge'])}}" class="btn btn-block p-0 border border-info {{$totalCancelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-info py-1">
                                                    <h5 class="font-weight-bolder mb-0">Cancel Accept By Incharge</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalCancelAcceptByIncharge}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('merchant.parcel.index',['status'=>'cancel_accept_by_merchant'])}}" class="btn btn-block p-0 border border-success {{$totalCancelAcceptByMerchant==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-success py-1">
                                                    <h5 class="font-weight-bolder mb-0">Cancel Accept By Merchant</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalCancelAcceptByMerchant}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
{{--                            <div class="d-flex justify-content-center">--}}
{{--                                <div role="group" class="btn-group btn-group-sm">--}}
{{--                                    <a href="{{route('merchant.parcel.index')}}"--}}
{{--                                       class="btn btn-primary mr-1 rounded {{$totalPendingParcel==0 ? 'disabled' : ''}}">All--}}
{{--                                        ({{$totalParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'pending'])}}"--}}
{{--                                       class="btn btn-warning mr-1 rounded {{$totalPendingParcel==0 ? 'disabled' : ''}}">Pending--}}
{{--                                        ({{$totalPendingParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'transit'])}}"--}}
{{--                                       class="btn btn-info mr-1 rounded {{$totalTransitParcel==0 ? 'disabled' : ''}}">Transit--}}
{{--                                        ({{$totalTransitParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'partial'])}}"--}}
{{--                                       class="btn btn-warning mr-1 rounded {{$totalPartialParcel==0 ? 'disabled' : ''}}">Partial--}}
{{--                                        ({{$totalPartialParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'delivered'])}}"--}}
{{--                                       class="btn btn-success mr-1 rounded {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">Delivered--}}
{{--                                        ({{$totalDeliveredParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'hold'])}}"--}}
{{--                                       class="btn btn-warning mr-1 rounded {{$totalHoldParcel==0 ? 'disabled' : ''}}">Hold--}}
{{--                                        ({{$totalHoldParcel}})</a>--}}
{{--                                    <a href="{{route('merchant.parcel.index',['status'=>'cancelled'])}}"--}}
{{--                                       class="btn btn-danger mr-1 rounded {{$totalCancelParcel==0 ? 'disabled' : ''}}">Cancelled--}}
{{--                                        ({{$totalCancelParcel}})--}}
{{--                                    </a> <a href="{{route('merchant.parcel.index',['status'=>'cancel_accept_by_incharge'])}}"--}}
{{--                                       class="btn btn-danger mr-1 rounded {{$totalCancelAcceptByIncharge==0 ? 'disabled' : ''}}">Cancel Parcel Accept By Incharge--}}
{{--                                          ({{$totalCancelAcceptByIncharge}})</a>--}}
{{--                                    </a> <a href="{{route('merchant.parcel.index',['status'=>'cancel_accept_by_merchant'])}}"--}}
{{--                                       class="btn btn-success mr-1 rounded {{$totalCancelAcceptByMerchant==0 ? 'disabled' : ''}}">Cancel Parcel Accept By Merchant--}}
{{--                                        ({{$totalCancelAcceptByMerchant}})</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
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
                "pageLength": 1000,
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('merchant.parcel.index', ['status'=>request('status')]) !!}',
                columns: [
                    {data: "DT_RowIndex", title: "SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "customer_details", title: "Customer Details", searchable: false, orderable: false},
                    {data: "tracking_id", title: "Tracking ID", searchable: true, orderable: true},
                    {data: "invoice_id", title: "Invoice Number", searchable: true, orderable: true},
                    {data: "date_time", title: "Date & Time", searchable: false, orderable: false},
                    {data: "rider_info", title: "Assign Rider", searchable: false, orderable: false, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "payment_details", title: "Payment Details", searchable: true, orderable: true},
                    {data: "status", title: "Status", orderable: false, searchable: false},
                    {data: "customer_mobile", "visible": false, orderable: true, searchable: true},
                    {data: "action", title: "Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
