@extends('layouts.master')

@section('title', 'Rider list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Rider list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Rider list' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Rider List')}}</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('admin.rider.create')}}"
                                       class="btn btn-primary">{{__('Add Rider')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-secondary table-bordered table-striped">
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
                ajax: '{{ route('admin.rider.index') }}',
                columns: [
                    {data: "DT_RowIndex", title: "SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "rider_info", title: "Rider Info", searchable: true},
                    {data: "salary_info", title: "Salary Info", searchable: true},
                    {data: "address_info", title: "Address Info", searchable: true},
                    {data: "name", "visible": false, searchable: true},
                    {data: "rider_code", "visible": false, searchable: true},
                    {data: "mobile", "visible": false, searchable: true},
                    {data: "email", "visible": false, searchable: true},
                    {data: "nid", "visible": false, searchable: true},
                    {data: "area_info", title: "Area Info", searchable: true},
                    {
                        data: "area.area_name",
                        "visible": false,
                        searchable: true,
                        "defaultContent": '<i class="text-danger">Area Not Set</i>'
                    },
                    {
                        data: "area.area_code",
                        "visible": false,
                        searchable: true,
                        "defaultContent": '<i class="text-danger">Area Not Set</i>'
                    },
                    {
                        data: "hub.name",
                        title: "Hub Info",
                        searchable: true,
                        "defaultContent": '<i class="text-danger">Hub Not Set</i>'
                    },
                    // {data: "mobile", title:"Mobile Number", searchable: true},
                    {data: "status", title: "Status", orderable: false, searchable: false},
                    {data: "action", title: "Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
