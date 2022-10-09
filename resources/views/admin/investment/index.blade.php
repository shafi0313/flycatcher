@extends('layouts.master')

@section('title', 'Investment List')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Investment List'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Investment List' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Investment List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.investments.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  {{__('Add Investment')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table">
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
                ajax: '{{ route('admin.investments.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "title", title:"Title", searchable: true},
                    {data: "amount", title:"Amount (TK)", searchable: true},
                    {data: "added_by.name", title:"Created By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                    {data: "modified_by.name", title:"Updated By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
