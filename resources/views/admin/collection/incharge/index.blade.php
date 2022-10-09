@extends('layouts.master')

@section('title', 'Collection list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Collection list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Collection list' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Collection From Rider')}}</h4>
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
                ajax: '{{ route('admin.incharge.collection.index') }}',
                columns: [
                    {data: "DT_RowIndex", title: "SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "rider_info", title: "Rider Info", searchable: true},
                    {data: "collected_amount", title: "Collected Amount (TK)", searchable: true},
                    {data: "action", title: "Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
