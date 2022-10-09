@extends('layouts.master')
@section('title', 'Sub Area')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('admin.dashboard'),
            'Sub Area List'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Sub Area list' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> {{__('All Sub Area List')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.sub-area.create')}}" class="btn btn-primary">{{__('Add Sub Area')}}</a>
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
                ajax: '{{ route('admin.sub-area.index') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "name", title:"Sub Area Name", searchable: true},
                    {data: "code", title:"Sub Area Code", searchable: true},
                    {data: "area_info", title:"Area Info", searchable: true},
                    {data: "parcel_info", title:"Parcel Info", searchable: true},
                    {data: "rider_info", title:"Rider Info", searchable: true},
                    {data: "status",title:"Status", orderable: false, searchable: false},
                    {data: "action",title:"Action", orderable: false, searchable: false},
                ],
            });
        })
    </script>
@endpush
