@extends('layouts.master')

@section('title', 'Complaint list')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Complaint list'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Complaint list' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"><i class="fa fa-list"></i> {{__('All Complaint List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.complaints.create')}}" class="btn btn-primary"> {{__('Add Complaint')}}</a>
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
                ajax: '{{ route('admin.complaints.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "description", title:"Description", searchable: true},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
