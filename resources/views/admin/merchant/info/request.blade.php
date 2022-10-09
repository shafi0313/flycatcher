@extends('layouts.master')

@section('title', 'Merchant request')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Merchant request'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Merchant request' :links="$links" />
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> {{__('All Merchant request')}}</h4>
                            </div>
{{--                            <div class="dt-action-buttons text-right">--}}
{{--                                <div class="dt-buttons d-inline-flex">--}}
{{--                                    <a href="{{route('admin.merchant.create')}}" class="btn btn-primary">{{__('Add Merchant')}}</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
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
                ajax: '{{ route('admin.merchant.request') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:"Merchant Name", searchable: true},
                    {data: "company_name", title:"Company Name", searchable: true},
                    {data: "area", title:"Area Name", searchable: true},
                    {data: "mobile", title:"Mobile", searchable: true},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush

