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
                        <div class="col-12">
                            <a href="{{route('admin.incharge.invoice.slip', $invoice->id)}}" target="_blank" class="btn btn-info my-1 float-right"><i class="fas fa-print"></i>Print Now</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center" colspan="5">Parcel</th>
                                        <th class="text-center align-middle" rowspan="2">Amount (TK)</th>
                                    </tr>
                                    <tr>
                                        <th class="py-1">Delivered Parcel</th>
                                        <th class="py-1">Partial Delivered Parcel</th>
                                        <th class="py-1">Exchange Delivered Parcel</th>
                                        <th class="py-1">Cancle Parcel</th>
                                        <th class="py-1">Total Parcel</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 
                                            <?php
                                            $delivered = 0;
                                            foreach ($invoice->invoiceItems as $item) {
                                                if ($item->parcel->status === 'delivered') {
                                                    $delivered = $delivered + 1;
                                                }
                                            }
                                            ?>
                                            {{ $delivered }}
                                        </td>
                                        <td class="py-1">
                                        <?php
                                            $partial = 0;
                                            foreach ($invoice->invoiceItems as $item) {
                                                if ($item->parcel->status === 'partial') {
                                                    $partial = $partial + 1;
                                                }
                                            }
                                            ?>
                                            {{ $partial }}
                                        </td>
                                        <td class="py-1">
                                            <?php
                                            $exchange = 0;
                                            foreach ($invoice->invoiceItems as $item) {
                                                if ($item->parcel->status === 'exchange') {
                                                    $exchange = $exchange + 1;
                                                }
                                            }
                                            ?>
                                            {{ $exchange }}
                                        </td>
                                        <td class="py-1">
                                            <?php
                                            $cancelled = 0;
                                            foreach ($invoice->invoiceItems as $item) {
                                                if ($item->parcel->status === 'cancelled') {
                                                    $cancelled = $cancelled + 1;
                                                }
                                            }
                                            ?>
                                            {{ $cancelled }}
                                        </td>
                                        <td class="py-1">
                                            {{ $invoice->invoiceItems->count() }}
                                        </td>
                                        <td class="py-1">
                                            {{$invoice->total_collection_amount}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="card ">
                        <div class="col-12">
                            <h4 class="float-left  my-1">Parcel List</h4>
                            <a href="{{route('admin.incharge.invoice.pdf', $invoice->id)}}" target="_blank" class="btn btn-info my-1 float-right"><i class="fas fa-print"></i>Print Now</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="py-1">SL NO</th>
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