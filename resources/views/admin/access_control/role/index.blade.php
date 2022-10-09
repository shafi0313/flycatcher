@extends('layouts.master')
@section('title', 'Role list')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Role list'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Role list' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> {{__('All Role List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.role.create')}}" class="btn btn-primary">{{__('Add Role')}}</a>
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
                ajax: '{{ route('admin.role.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "role_name", title:"Name", searchable: true},
                    {data: "guard_name", title:"Guard Name", searchable: true},
                    {data: "name", "visible":false, searchable: true},
                    {data: "guard_name", "visible":false, searchable: true},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
