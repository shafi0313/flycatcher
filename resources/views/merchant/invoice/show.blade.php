@extends('merchant.layouts.master')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/app-invoice.css">
@endpush

@section('title', 'Invoice details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('merchant.dashboard'),
                'Invoice list'=>route('merchant.invoice'),
                'Invoice details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Invoice details' :links="$links"/>
        <div class="content-body">
            <section class="invoice-preview-wrapper">
                <div class="row invoice-preview">
                    <!-- Invoice -->
                    <div class="col-12">
                        <div class="card ">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-6">
                                        <p class="card-text mb-25">Block C, Section C, House 181/182</p>
                                        <p class="card-text mb-25">Mirpur Dhaka, Bangladesh</p>
                                        <p class="card-text mb-1">+8801777873960</p>
                                        @if($invoice->status === 'pending')
                                            <form action="{{route('merchant.invoice.accept', $invoice->id)}}"
                                                  method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button class="btn btn-sm btn-primary">Accept Now</button>
                                            </form>
                                        @endif

                                    </div>
                                    <div class="col-6">
                                        <h4 class="invoice-title text-right mb-1">Invoice <span
                                                class="invoice-number">#{{$invoice->invoice_number}}</span></h4>
                                        <p class="invoice-date-title text-right">Date
                                            Issued: {{date('d M Y', strtotime($invoice->created_at))}}</p>
                                        <p class="text-right"><b>Status: </b>
                                            @if($invoice->status === 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-primary">Accepted</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <hr class="invoice-spacing"/>

                            <div class="card-body invoice-padding pt-0">
                                <div class="row">
                                    <div class="col-xl-8">
                                        <h6 class="mb-2">Invoice To:</h6>
                                        <h6 class="mb-25">{{$invoice->prepare_for->name}}</h6>
                                        <p class="card-text mb-25">{{$invoice->prepare_for->mobile}}</p>
                                        <p class="card-text mb-25">{{$invoice->prepare_for->company_name}}</p>
                                    </div>
                                    <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                        <h6 class="mb-2">Payment Details:</h6>
                                        <div class="table-responsive float-right">
                                            <table width="100%">
                                                <tbody>
                                                <tr>
                                                    <td class="pr-1">Sub total</td>
                                                    <td>:</td>
                                                    <td><span class="font-weight-bold text-right">{{$invoice->total_collection_amount}} TK</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Total Cod</td>
                                                    <td>:</td>
                                                    <td>{{$invoice->total_cod?? 0}} TK</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Total Delivery Charge</td>
                                                    <td>:</td>
                                                    <td>{{$invoice->total_delivery_charge?? 0}} TK</td>
                                                </tr>
                                                <tr>
                                                    <td class="pr-1">Invoice Total</td>
                                                    <td>:</td>
                                                    <td>{{$invoice->total_collection_amount - $invoice->total_delivery_charge -$invoice->total_cod }}
                                                        TK
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3>Parcel List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="dataTable"
                                           class="datatables-basic table table-bordered table-secondary table-striped table-secondary">
                                        {{-- show from datatable--}}
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
                        ajax: '{{route('merchant.invoice.show', $invoice->id)}}',
                        columns: [{
                            data: "DT_RowIndex",
                            title: "SL",
                            name: "DT_RowIndex",
                            searchable: false,
                            orderable: false
                        },
                            {
                                data: "parcel_tracking_id",
                                title: "Tracking ID",
                                searchable: false,
                                orderable: false
                            },
                            {
                                data: "parcel.invoice_id",
                                title: "Invoice ID",
                                searchable: false,
                                orderable: false
                            },

                            {
                                data: "parcel_price",
                                title: "Parcel Price (TK)",
                                searchable: true,
                                orderable: true
                            },
                            {
                                data: "original_collection",
                                title: "Collected Amount (TK)",
                                searchable: true,
                                orderable: true
                            },

                            {
                                data: "delivery_charge",
                                title: "Delivery Charge (TK)",
                                searchable: true,
                                orderable: true
                            },
                            {
                                data: "cod_charge",
                                title: "COD Charge (TK)",
                                searchable: true,
                                orderable: true
                            },

                            {
                                data: "receivable",
                                title: "Received Amount (TK)",
                                searchable: true,
                                orderable: true
                            },

                            {
                                data: "parcel.tracking_id",
                                title: "Collected Amount (TK)",
                                "visible": false,
                                searchable: true,
                                orderable: true
                            },
                        ],
                    });
                })
            </script>
    @endpush

