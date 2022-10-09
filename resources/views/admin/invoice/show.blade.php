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
                        <div class="card-body ">
                            <div class="row">
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <a href="{{route('admin.invoice.pdf', $invoice->id)}}" target="_blank" class="btn btn-info mr-2"><i class="fas fa-print"></i>Print Now</a>
                                        <a href="{{route('admin.invoice.excel', $invoice->id)}}" target="_blank" class="btn btn-primary"><i class="fas fa-print"></i>Excel Now</a>
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
                                        <th class="tc bb">#</th>
                                        <th class="tc bb">Invoice id</th>
                                        <th class="tc bb">tracking id</th>
                                        <th class="tc bb">Date</th>
                                        <th class="tc bb">Area</th>
                                        <th class="tc bb">Status</th>
                                        <th class="tc bb">Customer mobile</th>
                                        <th class="tc bb">Parcel Price (TK)</th>
                                        <th class="tc bb">Amount (TK)</th>
                                        <th class="tc bb">Cod(TK)</th>
                                        <th class="tc bb">Delivery Charge (TK)</th>
                                        <th class="tc bb">Payable (TK)</th>
                                        <th class="tc bb">Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice->invoiceItems as $item)
                                    <tr>
                                        <td class="tc bb">{{$loop->iteration }}</td>
                                        <td class="tc bb">{{$item->parcel->invoice_id}}</td>
                                        <td class="tc bb">{{$item->parcel->tracking_id}}</td>
                                        <td class="tc bb">{{date('d-M-Y',strtotime($item->parcel->added_date))}}</td>
                                        <td class="tc bb">{{$item->parcel->sub_area->name ??''}}({{$item->parcel->sub_area->code ??''}})</td>
                                        <td class="tc bb">{{ucfirst($item->parcel->status)}}</td>
                                        <td class="tc bb">{{$item->parcel->customer_mobile}}</td>
                                        <td class="tr bb">{{number_format($item->parcel->collection_amount)}}</td>
                                        <td class="tr bb">{{number_format($item->collection_amount)}}</td>
                                        <td class="tr bb">{{number_format($item->cod_charge)}}</td>
                                        <td class="tr bb">{{number_format($item->delivery_charge)}}</td>
                                        <td class="tr bb">{{number_format($item->net_payable)}}</td>
                                        <td class="bb">{{$item->parcel->collection->note ??''}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr class="invoice-spacing" />
                        <div class="card-body invoice-padding pt-0">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-center">
                                        <span class="font-weight-bold">Invoice Created By:</span>
                                        <span>{{$invoice->invoice->name??''}}</span>
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