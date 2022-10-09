@extends('merchant.layouts.master')
@section('title', 'Coverage Area')
@section('content')
<div class="content-wrapper">
    @php
        $links = [
            'Home'=>route('merchant.dashboard'),
            'Coverage Area'=>''
        ]
    @endphp
    <x-bread-crumb-component title='Coverage Area' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row" id="table-responsive">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0"> {{__('Coverage Area')}}</h4>
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
                ajax: '{{ route('merchant.coverage.area') }}',
                columns: [
                    {data: "DT_RowIndex",title:"SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "area.area_name", title:"Area Name", searchable: true},
                    {data: "name", title:"Sub Area Name", searchable: true},
                    {data: "code", title:"Sub Area Code", searchable: true},
                ],
            });
        })
    </script>
@endpush
