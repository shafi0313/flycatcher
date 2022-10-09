@extends('layouts.master')
@section('title', 'Permission List')
@section('content')
<div class="content-wrapper">
    @include('components.bread-crumb-component', [
    'title'=>'Permission list',
    'links'=>[
        'Home'=>route('admin.dashboard'),
         'Permission list'=>''
        ]
    ])
{{--    <x-bread-crumb-component title='Permission list' :links="$links" />--}}
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Permission List</h4>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.permission.create')}}" class="btn btn-primary">{{__('Add Permission')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table table-striped table-secondary table-bordered">
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
                ajax: '{{ route('admin.permission.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "permission_name", title:"Name", searchable: true},
                    {data: "name", title:"Permission Name", searchable: true},
                    {data: "guard_name", "visible":false, searchable: true},
                    {data: "group_name", "visible":false, searchable: true},
                    {data: "guard_name", title:"Guard Name", searchable: true},
                    {data: "group_name", title:"Group Name", searchable: true},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
