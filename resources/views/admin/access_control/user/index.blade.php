@extends('layouts.master')

@section('title', 'User List')
@section('content')

<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'User list'=>''
        ]
    @endphp
    <x-bread-crumb-component title='User list' :links="$links" />
    <div class="content-body">
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> {{__('All User List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.admin.create')}}" class="btn btn-primary">{{__('Add User')}}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive">
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
                ajax: '{{ route('admin.admin.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:"Name", searchable: true},
                    {data: "email", title:"Email", searchable: true},
                    {data: "mobile", title:"Mobile", searchable: true},
                    {data: "hub.name", title:"Hub Name", searchable: true},
                    {data: "role_info", title:"Role", searchable: true, "defaultContent": '<i class="text-danger">Not set</i>'},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
