@extends('layouts.master')

@section('title', 'Collection summary')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Collection summary'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Collection summary' :links="$links"/>
        <div class="content-body">
            <div class="row" id="table-responsive">
                <div class="col-6">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"><i class="fa fa-list"></i> {{__('Rider Collection Summary')}}</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table">
                                {{--  show from datatable--}}
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"><i class="fa fa-list"></i> {{__('Incharge Collection Summary')}}</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTableIncharge" class="datatables-basic table">
                                <thead>
                                <tr>
                                    <th>SL NO</th>
                                    <th>Name</th>
                                    <th>Waiting for Accept</th>
                                    <th>Current Balance (TK)</th>
                                    <th>Transfer request (TK)</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($incharges as $incharge)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$incharge->name}}</td>
                                        <td>{{$incharge->incharge_waiting_for_accept}}</td>
                                        <td>{{number_format($incharge->incharge_current_balance)}}</td>
                                        <td>{{number_format($incharge->incharge_request_for_transfer)}}</td>
                                    </tr>
                                @endforeach

                                </tbody>
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
                ajax: '{{ route('admin.collection.summary') }}',
                columns: [
                    {data: "DT_RowIndex", title: "SL", name: "DT_RowIndex", searchable: false, orderable: false},
                    {data: "rider_name", title: "Rider Name", searchable: true},
                    {data: "current_balance", title: "Current Balance (TK)", searchable: true},
                    {data: "transfer_request", title: "Transfer request (TK)", searchable: true},
                ],
            });
        })
    </script>
@endpush
