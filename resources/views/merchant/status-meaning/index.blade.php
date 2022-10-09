@extends('layouts.master')
@section('title', 'Status Meaning')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('merchant.dashboard'),
            'Status Meaning list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Status Meaning list' :links="$links" />
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0">Status Meaning</h4>
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
        $(document).ready(function() {
            var table = $('#dataTable').dataTable({
                // stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('merchant.status-meanings.index') !!}',
                columns: [
                    {
                        data: "DT_RowIndex",
                        title: "SL",
                        name: "DT_RowIndex",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "name",
                        title: "Name",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "description",
                        title: "Description",
                        searchable: false,
                        orderable: false,
                        "defaultContent": '<i class="text-danger">Area Not Set</i>'
                    },
                ],
            });
        })
    </script>
@endpush


