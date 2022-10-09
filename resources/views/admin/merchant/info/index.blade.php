@extends('layouts.master')

@section('title', 'Merchant list')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Merchant list'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Merchant list' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> All {{$status ? ucfirst($status) : 'Pending'}} Merchant</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.merchant.create')}}" class="btn btn-primary">{{__('Add Merchant')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <div class="d-flex justify-content-center">
                            <div  role="group" class="btn-group btn-group-sm">
                                <a href="{{route('admin.merchant.index')}}" class="btn btn-primary mr-1 rounded {{$all==0 ? 'disabled' : ''}}">All ({{$all}})</a>
                                <a href="{{route('admin.merchant.index',['status'=>'pending'])}}" class="btn btn-warning mr-1 rounded {{$pending==0 ? 'disabled' : ''}}">Pending ({{$pending}})</a>
                                <a href="{{route('admin.merchant.index',['status'=>'active'])}}" class="btn btn-success mr-1 rounded {{$active==0 ? 'disabled' : ''}}">Active ({{$active}})</a>
                                <a href="{{route('admin.merchant.index',['status'=>'inactive'])}}" class="btn btn-danger mr-1 rounded {{$inactive==0 ? 'disabled' : ''}}">Inactive ({{$inactive}})</a>
                            </div>
                        </div>
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
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('admin.merchant.index', ['status'=>request('status')]) !!}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "merchant_info", title:"Merchant Info", searchable: true},
                    {data: "name", "visible":false, searchable: true},
                    {data: "email", "visible":false, searchable: true},
                    {data: "company_name", title:"Company Name", searchable: true},
                    {data: "area_info", title:"Area Name", searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "mobile", "visible":false, searchable: true},
                    {data: "parcel_info", title:"Parcel Info", searchable: true},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "cancel_charge",title:"Cancel Charge", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                    {data: "area.area_name","visible":false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                    {data: "area.area_code","visible":false, orderable: true, searchable: true, "defaultContent": '<i class="text-danger">Area Not Set</i>'},
                ],
            });
        })
    </script>
@endpush
