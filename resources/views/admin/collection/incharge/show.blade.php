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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Rider name:</h2>
                                </div>
                                <div class="">
                                    {{$rider->name}} ({{$rider->rider_code}})
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Rider Mobile:</h2>
                                </div>
                                <div class="">
                                    {{$rider->mobile}}
                                </div>
                            </div>
                        </div>
                </div>
                <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <div>
                                    <h2 class="font-weight-bolder mb-0">Rider Email:</h2>
                                </div>
                                <div class="">
                                    {{$rider->email}}
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
                                <form action="{{route('admin.collection.incharge.collect', $rider->id)}}" method="POST">
                                    @csrf
                                    @method('put')
                                    <button class="btn btn-primary" type="submit" title="Collect Now">
                                        Accept Now
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="datatables-basic table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl no</th>
                                        <th>Parcel Tracking ID</th>
                                        <th>Parcel Invoice ID</th>
                                        <th>Customer Info</th>
                                        <th>Merchant Info</th>
                                        <th>Original Price (TK)</th>
                                        <th>Collected Amount (TK)</th>
                                        <th>Note</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $collectionTotal = 0;
                                $originalTotal = 0;
                                @endphp
                                @foreach($collections as $collection)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$collection->parcel->tracking_id}}</td>
                                        <td>{{$collection->parcel->invoice_id}}</td>
                                        <td>
                                            <p><b>Name: </b>{{$collection->parcel->customer_name}}</p>
                                            <p><b>Mobile: </b>{{$collection->parcel->customer_mobile}}</p>
                                        </td>
                                        <td>
                                            <p><b>Name: </b>{{$collection->parcel->merchant->name}}</p>
                                            <p><b>Mobile: </b>{{$collection->parcel->merchant->mobile}}</p>
                                        </td>
                                        <td>{{$collection->parcel->collection_amount}}</td>
                                        <td>{{$collection->amount}}</td>
                                        <td>{{$collection->note}}</td>
                                        @php
                                            $originalTotal = $originalTotal+$collection->parcel->collection_amount;
                                            $collectionTotal = $collectionTotal+$collection->amount;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <th colspan="5" class="text-right">Total</th>
                                    <td>{{$originalTotal}} TK</td>
                                    <td>{{$collectionTotal}} TK</td>
                                    <td></td>
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



