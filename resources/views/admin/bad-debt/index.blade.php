@extends('layouts.master')

@section('title', 'Bad Debt List')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Bad Debt List'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Bad Debt List' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Bad Debt List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.bad-debts.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>  {{__('Add Bad Debt')}}</a>
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
                ajax: '{{ route('admin.bad-debts.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "title", title:"Title", searchable: true},
                    {data: "amount", title:"Amount (TK)", searchable: true},
                    {data: "receivable_amount", title:"Receivable Amount (TK)", searchable: true},
                    {data: "received_amount", title:"Received Amount (TK)", searchable: true},
                    {data: "added_by.name", title:"Created By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                    {data: "modified_by.name", title:"Updated By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
