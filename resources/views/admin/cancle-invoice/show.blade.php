@extends('layouts.master')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/app-invoice.css">
@endpush

@section('title', 'Cancle Invoice details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Cancle Invoice list'=>route('admin.cancle-invoice.index'),
    'Cancle Invoice Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Cancle Invoice details' :links="$links" />
    <div class="content-body">
        <section class="invoice-preview-wrapper">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-12">
                    <div class="card ">
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{route('admin.cancle-invoice.pdf', $invoice->id)}}" target="_blank" class="btn btn-info mr-2"><i class="fas fa-print"></i>Print Now</a>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-right">Invoice <span class="invoice-number">#{{$invoice->invoice_number}}</span>
                                    </h4>

                                    <p class="invoice-date-title text-right">Date Issued: {{date('d M Y', strtotime($invoice->created_at))}}</p>

                                </div>
                            </div>
                        </div>

                        <hr class="invoice-spacing" />

                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-xl-8">
                                    <h6 class="mb-2">Invoice To:</h6>
                                    <h6 class="mb-25">{{$invoice->merchant->name}}</h6>
                                    <p class="card-text mb-25">{{$invoice->merchant->mobile}}</p>
                                    <p class="card-text mb-25">{{$invoice->merchant->company_name}}</p>
                                </div>
                                <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                                    <h6 class="mb-2">Payment Details:</h6>
                                    <div class="table-responsive float-right">
                                        <table width="100%">
                                            <tbody>
                                                <tr>
                                                    <td class="pr-1">Sub total</td>
                                                    <td>:</td>
                                                    <td><span class="font-weight-bold text-right">{{$invoice->total_collection_amount}} TK</span></td>
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
                                                    <td>{{$invoice->total_collection_amount - $invoice->total_delivery_charge -$invoice->total_cod }} TK</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <h4>Parcel List</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="py-1">SL NO</th>
                                        <th class="py-1">Invoice ID</th>
                                        <th class="py-1">Tracking ID</th>
                                        <th class="py-1">Status</th>
                                        <th class="py-1">Parcel Price (TK)</th>
                                        <th class="py-1">Collection Amount (TK)</th>
                                        <th class="py-1">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->invoiceItems as $item)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{$item->parcel->invoice_id}}</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{$item->parcel->tracking_id}}</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{$item->parcel->status}}</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{$item->parcel->collection_amount}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{$item->parcel->parcelCollection->collection_amount}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{$item->note}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-body invoice-padding pb-0">
                            <div class="row invoice-sales-total-wrapper">
                                <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                                    <p class="card-text mb-0">
                                        <span class="font-weight-bold">Salesperson:</span> <span class="ml-75">Alfie Solomons</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr class="invoice-spacing" />
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center">
                                        <span class="font-weight-bold">Note:</span>
                                        <span>It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                                            projects. Thank You!</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Invoice Note ends -->
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection

    @push('script')
    <script src="{{asset('/')}}app-assets/js/scripts/pages/app-invoice.js"></script>
    @endpush