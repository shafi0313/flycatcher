@extends('layouts.master')
@section('title', 'Due list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Due list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Due List' :links="$links"/>
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Due List</h4>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{route('admin.account.due.print')}}" class="btn btn-primary mr-2" target="_blank">{{__('Print Now')}}</a>
                                    <a href="{{route('admin.invoice.create')}}" class="btn btn-primary">{{__('Invoice Create')}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table table-bordered table-secondary table-striped">
                                {{-- show from datatable--}}
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
                ajax: '{!! route('admin.account.due') !!}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "merchant_info", title:"Merchant Info", searchable: true},
                    {data: "due", title:"Due (TK)", searchable: true},
                    {data: "merchant.name", "visible":false, searchable: true},
                    {data: "merchant.mobile", "visible":false, searchable: true},

                ],
            });
        })
    </script>
@endpush
