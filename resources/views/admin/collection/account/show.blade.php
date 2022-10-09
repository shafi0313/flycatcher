@extends('layouts.master')

@section('title', 'Collection Details')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Collection Details'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Collection list' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Incharge name:</h2>
                                </div>
                                <div class="">
                                    {{$incharge->name}}
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Incharge Mobile:</h2>
                                </div>
                                <div class="">
                                    {{$incharge->mobile}}
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Incharge Email:</h2>
                                </div>
                                <div class="">
                                    {{$incharge->email}}
                                </div>
                            </div>
                        </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0"><i class="fa fa-list"></i>Collection Details</h4>
                            </div>

                            <div class="dt-action-buttons text-right">
                                <form action="{{route('admin.collection.account.collect', $incharge->id)}}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-primary" type="submit" title="Collect Now">
                                        Collect Now
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="datatables-basic table">
                                <thead>
                                    <tr>
                                        <th>Parcel Tracking ID</th>
                                        <th>Parcel Invoice ID</th>
                                        <th>Customer Info</th>
                                        <th>Merchant Info</th>
                                        <th>Delivery Charge (TK)</th>
                                        <th>Cod Charge (TK)</th>
                                        <th>Original Price</th>
                                        <th>Collected Amount</th>
                                        <th>Net Payable</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $totalDeliveryCharge = 0;
                                    $totalCodCharge = 0;
                                    $collectionTotal = 0;
                                    $originalTotal = 0;
                                    $totalPayable = 0;
                                @endphp
                                @foreach($collections as $collection)
                                    <tr>
                                        <td>{{$collection->parcel->tracking_id}}</td>
                                        <td>{{$collection->parcel->invoice_id}}</td>
                                        <td>
                                            <p><b>Customer Name: </b>{{$collection->parcel->customer_name}}</p>
                                            <p><b>Customer Mobile: </b>{{$collection->parcel->customer_mobile}}</p>
                                        </td>
                                        <td>
                                            <p><b>Name: </b>{{$collection->parcel->merchant->name}}</p>
                                            <p><b>Mobile: </b>{{$collection->parcel->merchant->mobile}}</p>
                                        </td>
                                        <td>{{$collection->delivery_charge}}</td>
                                        <td>{{$collection->cod_charge}}</td>
                                        <td>{{$collection->parcel->collection_amount}}</td>
                                        <td>{{$collection->amount}}</td>
                                        <td>{{$collection->net_payable}}</td>
                                        @php
                                            $totalDeliveryCharge = $totalDeliveryCharge+$collection->delivery_charge;
                                            $totalCodCharge = $totalCodCharge+$collection->cod_charge;
                                            $originalTotal = $originalTotal+$collection->parcel->collection_amount;
                                            $collectionTotal = $collectionTotal+$collection->amount;
                                            $totalPayable = $totalPayable+$collection->net_payable;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="4" class="text-right">Total:</th>
                                    <th>{{$totalDeliveryCharge}}</th>
                                    <th>{{$totalCodCharge}}</th>
                                    <th>{{$collectionTotal}}</th>
                                    <th>{{$collectionTotal}}</th>
                                    <th>{{$totalPayable}}</th>
                                </tr>
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



