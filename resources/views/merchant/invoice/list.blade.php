
@extends('merchant.layouts.master')
@section('title', 'Invoice list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('merchant.dashboard'),
            'Invoice list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Invoice list' :links="$links" />
        <div class="content-body" id="">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"> Invoice</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <div class="d-flex justify-content-center">
                                <div  role="group" class="btn-group btn-group-sm">
                                    <a href="{{route('merchant.invoice')}}" class="btn btn-primary mr-1 rounded {{$all==0 ? 'disabled' : ''}}">All ({{$all}})</a>
                                    <a href="{{route('merchant.invoice',['status'=>'pending'])}}" class="btn btn-warning mr-1 rounded {{$pending==0 ? 'disabled' : ''}}">Pending({{$pending}})</a>
                                    <a href="{{route('merchant.invoice',['status'=>'accepted'])}}" class="btn btn-info mr-1 rounded {{$accepted==0 ? 'disabled' : ''}}">Accepted ({{$accepted}})</a>
                                </div>
                            </div>
                            <table id="dataTable" class="datatables-basic table">
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

            $('#dataTable').dataTable({
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: '{!! route('merchant.invoice', ['status'=>request('status')]) !!}',
                columns: [{
                    data: "DT_RowIndex",
                    title: "SL",
                    name: "DT_RowIndex",
                    searchable: false,
                    orderable: false
                },
                    {
                        data: "invoice_number",
                        title: "Invoice Number",
                    },
                    {
                        data: "date",
                        title: "Date & Time",
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: "total_collection_amount",
                        title: "Total Collection Amount (TK)",
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: "total_cod",
                        title: "Total Cod (TK)",
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: "total_delivery_charge",
                        title: "Total Delivery Charge (TK)",
                        searchable: true,
                        orderable: true
                    },
                    {
                        data: "action",
                        title: "Action",
                        searchable: true,
                        orderable: true
                    },

                ],
            });
        })
    </script>
@endpush
