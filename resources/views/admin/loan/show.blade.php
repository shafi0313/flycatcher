@extends('layouts.master')

@section('title', 'loan Details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'loan List'=>route('admin.loans.index'),
    'loan Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Loan details' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Loan Details')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.loans.index')}}" class="btn btn-primary">{{__('View Loan List')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Title:</b> {{$loan->title}}</td>
                                    <td><b>Amount:</b> {{$loan->amount}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Additional Note:</b> {{$loan->note}}</td>
                                </tr>
                                <tr>
                                    <td><b>Created Date:</b> {{date('d M Y, i H A', strtotime($loan->created_at))}}</td>
                                    <td><b>Updated Date:</b> {{date('d M Y, i H A', strtotime($loan->updated_at))}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Created By:</b>
                                        {{$loan->added_by->name ?? ''}}
                                    </td>
                                    <td>
                                        <b>Updated By:</b>
                                        {{$loan->modified_by->name ?? ''}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Loan Adjustment Details')}}</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table id="dataTable" class="datatables-basic table table-secondary table-striped table-bordered">
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
                ajax: '{{ route('admin.loans.show', $loan->id) }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "amount", title:"Amount (TK)", searchable: true},
                    {data: "added_by.name", title:"Created By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                    // {data: "modified_by.name", title:"Updated By", searchable: true,  "defaultContent": '<i class="text-danger">Not set yet</i>'},
                ],
            });
        })
    </script>
@endpush
