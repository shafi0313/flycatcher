@extends('layouts.rider')

@push('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('/') }}app-assets/css/pages/app-invoice.css">
@endpush

@section('title', 'Invoice details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('rider.dashboard'),
                'Invoice list'=>route('rider.invoices.index'),
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
                              <div class="card-body invoice-padding">
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
                            <hr class="invoice-spacing" />
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
                                        <th class="py-1">Amount (TK)</th>
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
                                                <span class="font-weight-bold">{{$item->parcel->collection_amount}}</span>
                                            </td>
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
