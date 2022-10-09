@extends('layouts.rider')
@section('title', 'Parcel list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('rider.dashboard'),
                'Parcel list'=>''
            ];
        $status = str_replace('_', ' ', ucfirst($status));
        @endphp
        <x-bread-crumb-component title='Parcel {{$status}} list' :links="$links"/>
        <div class="content-body">
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
                            <div class="row">
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index')}}" class="btn btn-block p-0 border border-primary {{$totalParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0" >
                                                <div class="col-8 border-right-primary py-1">
                                                    <h5 class="font-weight-bolder mb-0">All</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'pending'])}}"  class="btn btn-block p-0 border border-warning {{$totalPendingParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-warning py-1">
                                                    <h5 class="font-weight-bolder mb-0">Pending</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalPendingParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'transit'])}}" class="btn btn-block p-0 border border-info {{$totalTransitParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-info py-1">
                                                    <h5 class="font-weight-bolder mb-0">Transit</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalTransitParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'partial'])}}" class="btn btn-block p-0 border border-warning {{$totalPartialParcel==0 ? 'disabled' : ''}}">
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
                            </div>
                            <div class="row mt-lg-1">
                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'delivered'])}}" class="btn btn-block p-0 border border-success {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-success py-1">
                                                    <h5 class="font-weight-bolder mb-0">Delivered</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalDeliveredParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'hold'])}}" class="btn btn-block p-0 border border-warning {{$totalHoldParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-warning py-1">
                                                    <h5 class="font-weight-bolder mb-0">Hold</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalHoldParcel}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'hold_accept_by_incharge'])}}" class="btn btn-block p-0 border border-warning {{$holdParcelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row text-center mx-0">
                                                <div class="col-8 border-right-warning py-1">
                                                    <h5 class="font-weight-bolder mb-0">Hold Parcel In Office</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$holdParcelAcceptByIncharge}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0">
                                    <a href="{{route('rider.parcel.index',['status'=>'cancelled'])}}" class="btn btn-block p-0 border border-danger {{$totalCancelParcel==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
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

                                <div class="col-md-3 col-sm-6 col-12 mb-2 mb-md-0 mt-1">
                                    <a href="{{route('rider.parcel.index',['status'=>'cancel_accept_by_incharge'])}}" class="btn btn-block p-0 border border-danger {{$totalCancelAcceptByIncharge==0 ? 'disabled' : ''}}">
                                        <div class="card-body p-0" >
                                            <div class="row  text-center mx-0">
                                                <div class="col-8 border-right-danger py-1">
                                                    <h5 class="font-weight-bolder mb-0">Parcel Accept By Incharge</h5>
                                                </div>
                                                <div class="col-4 py-1">
                                                    <h5 class="font-weight-bolder mb-0">{{$totalCancelAcceptByIncharge}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
{{--                        <div class=" card-body d-flex justify-content-center pb-2">--}}

{{--                            <table class="table">--}}
{{--                                <tbody>--}}
{{--                                <tr>--}}
{{--                                    <td ><a href="{{route('rider.parcel.index')}}" class="btn btn-primary btn-sm rounded {{$totalParcel==0 ? 'disabled' : ''}}">All ({{$totalParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'pending'])}}" class="btn btn-warning btn-sm rounded {{$totalPendingParcel==0 ? 'disabled' : ''}}">Pending ({{$totalPendingParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'transit'])}}" class="btn btn-info btn-sm rounded {{$totalTransitParcel==0 ? 'disabled' : ''}}">Transit ({{$totalTransitParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'partial'])}}" class="btn btn-warning btn-sm rounded {{$totalPartialParcel==0 ? 'disabled' : ''}}">Partial ({{$totalPartialParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'delivered'])}}" class="btn btn-success btn-sm rounded {{$totalDeliveredParcel==0 ? 'disabled' : ''}}">Delivered ({{$totalDeliveredParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'hold'])}}" class="btn btn-warning btn-sm rounded {{$totalHoldParcel==0 ? 'disabled' : ''}}">Hold ({{$totalHoldParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'cancelled'])}}" class="btn btn-danger btn-sm rounded {{$totalCancelParcel==0 ? 'disabled' : ''}}">Cancelled ({{$totalCancelParcel}})</a></td>--}}

{{--                                    <td class="p-1"><a href="{{route('rider.parcel.index',['status'=>'cancel_accept_by_incharge'])}}" class="btn btn-danger btn-sm rounded {{$totalCancelAcceptByIncharge==0 ? 'disabled' : ''}}">Cancel Parcel Accept By Incharge ({{$totalCancelAcceptByIncharge}})</a></td>--}}
{{--                                </tr>--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-bordered table-hover">
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
                ajax: '{!! route('rider.parcel.index', ['status'=>request('status')]) !!}',
                columns: [
                    {data: "parcel_details", title: "Customer Details", searchable: false, orderable: false},
                    {data: "merchant.name", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "tracking_id", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "invoice_id", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "merchant.mobile", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "customer_name", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "customer_mobile", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "customer_address", "visible": false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                ],
            });
        })
    </script>


@endpush
