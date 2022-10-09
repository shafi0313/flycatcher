@extends('layouts.master')

@section('title', 'Bad Debt Details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'loan List'=>route('admin.bad-debts.index'),
    'loan Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Bad Debt details' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Bad Debt Details')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.bad-debts.index')}}" class="btn btn-primary">{{__('View Bad Debt List')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><b>Title:</b> {{$badDebt->title}}</td>
                                    <td><b>Amount:</b> {{$badDebt->amount}}</td>
                                </tr>
                                <tr>
                                    <td colspan="2"><b>Additional Note:</b> {{$badDebt->note}}</td>
                                </tr>
                                <tr>
                                    <td><b>Created Date:</b> {{date('d M Y, i H A', strtotime($badDebt->created_at))}}</td>
                                    <td><b>Updated Date:</b> {{date('d M Y, i H A', strtotime($badDebt->updated_at))}}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Created By:</b>
                                        {{$badDebt->added_by->name ?? ''}}
                                    </td>
                                    <td>
                                        <b>Updated By:</b>
                                        {{$badDebt->modified_by->name ?? ''}}
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
                ajax: '{{ route('admin.bad-debts.show', $badDebt->id) }}',
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
