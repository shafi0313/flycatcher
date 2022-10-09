@extends('layouts.master')

@section('title', 'Expense List')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Expense List'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Expense List' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Expense List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.expense.print')}}" class="btn btn-info mr-1"> {{__('Print Expense')}}</a>
                                <a href="{{route('admin.expense.create')}}" class="btn btn-primary"> {{__('Add Expense')}}</a>
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
                ajax: '{{ route('admin.expense.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "expense_title", title:"Title", searchable: true},
                    {data: "amount", title:"Amount (TK)", searchable: true},
                    // {data: "created_by.name", title:"Created By", searchable: true},
                    // {data: "updated_by.name", title:"Updated By", searchable: true},
                    {data: "create_update_by", title:"Created & Updated By", searchable: true},
                    {data: "create_update_date", title:"Create & Update Time", searchable: true},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
