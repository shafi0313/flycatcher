@extends('layouts.master')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/app-invoice.css">
@endpush

@section('title', 'Invoice details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Invoice list'=>route('admin.invoice.index'),
    'Invoice details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Invoice details' :links="$links" />
    <div class="content-body">

        <section class="invoice-preview-wrapper">
            <div class="row invoice-preview">
                <!-- Invoice -->
                <div class="col-12">
                    <div class="card ">

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body d-flex justify-content-end">
                                        <a href="{{route('admin.incharge.invoice.pdf', $invoice->id)}}" target="_blank" class="btn btn-info mr-2"><i class="fas fa-print"></i>Print Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />

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
                                        <th class="py-1">Date</th>
                                        <th class="py-1">Invoice ID</th>
                                        <th class="py-1">Tracking ID</th>
                                        <th class="py-1">Merchant Info</th>
                                        <th class="py-1">Rider Info</th>
                                        <th class="py-1">Amount (TK)</th>
                                        <th class="py-1">COD (TK)</th>
                                        <th class="py-1">Delivery Charge (TK)</th>
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
                                            <p class="card-text font-weight-bold mb-25">
          
                                                {{ \Carbon\Carbon::parse($item->parcel->added_date)->format('d M Y') }}

                                            </p>
                                        </td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25">{{$item->parcel->tracking_id}}</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25"><b>Name:</b>{{$item->parcel->merchant->name}}</p>
                                            <p class="card-text font-weight-bold mb-25"><b>Mobile:</b>{{$item->parcel->merchant->mobile}}</p>
                                        </td>
                                        <td class="py-1">
                                            <p class="card-text font-weight-bold mb-25"><b>Name:</b>{{$item->parcel->rider->name}}</p>
                                            <p class="card-text font-weight-bold mb-25"><b>Mobile:</b>{{$item->parcel->rider->mobile}}</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{number_format($item->parcel->collection->amount)}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{number_format($item->parcel->collection->cod_charge)}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="font-weight-bold">{{number_format($item->parcel->collection->delivery_charge)}}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    @endsection

    @push('script')
    <script src="{{asset('/')}}app-assets/js/scripts/pages/app-invoice.js"></script>
    @endpush