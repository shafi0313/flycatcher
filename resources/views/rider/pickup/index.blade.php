@extends('layouts.rider')

@section('title','Pickup Request')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('rider.dashboard'),
                'Pickup Request list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Pickup Request list' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pickup Request {{$status}} List</h4>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-center">
                                <div role="group" class="btn-group btn-group-sm">
                                    <a href="{{route('rider.pickup-request.index')}}"
                                       class="btn btn-primary mr-1 rounded {{$total==0 ? 'disabled' : ''}}">All
                                        ({{$total}})</a>
                                    <a href="{{route('rider.pickup-request.index',['status'=>'assigned'])}}"
                                       class="btn btn-warning mr-1 rounded {{$assigned==0 ? 'disabled' : ''}}">Assigned
                                        ({{$assigned}})</a>
                                    <a href="{{route('rider.pickup-request.index',['status'=>'picked'])}}"
                                       class="btn btn-info mr-1 rounded {{$accepted==0 ? 'disabled' : ''}}">Accepted
                                        ({{$accepted}})</a>
                                    <a href="{{route('rider.pickup-request.index',['status'=>'picked'])}}"
                                       class="btn btn-success mr-1 rounded {{$picked==0 ? 'disabled' : ''}}">Picked
                                        ({{$picked}})</a>
                                </div>
                            </div>
                            <table id="dataTable" class="datatables-basic table"></table>
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
                ajax: '{!! route('rider.pickup-request.index', ['status'=>request('status')]) !!}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "merchant_details", title:"Merchant Details", searchable: true},
                    {data: "created_time", title: "Request Time", searchable: true},
                    {data: "merchant.mobile", 'visible': false, searchable: true, "defaultContent": '<i class="text-danger"> Not Set</i>'},
                    {data: "rider_assign", title: "Assign Option", searchable: true, "defaultContent": '<i class="text-danger"> Not Set</i>'},
                    {data: "total_pickup_parcel", title:"Total Collected Parcel", searchable: true, orderable: true},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
