@extends('merchant.layouts.master')
@section('title','Dashboard')
@section('content')
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{route('merchant.pickup-request.create')}}">
                <div class="card text-center border border-info">
                    <div class="card-body">
                        <h4>Pickup Request</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{route('merchant.parcel.create')}}">
                <div class="card text-center border border-success">
                    <div class="card-body">
                        <h4> Add Parcel</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="{{route('merchant.payment-request.create')}}">
                <div class="card text-center border border-primary">
                    <div class="card-body">
                        <h4>Payment Request</h4>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <a href="">
                <div class="card text-center border border-success">
                    <div class="card-body">
                        <h4>Payment</h4>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder  mb-0">{{ $total_parcel }}</h2>
                        <p class="card-text">Total Parcel</p>
                    </div>
                    <div class="avatar bg-light-primary p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='box'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">{{ $total_parcel_delivered }}</h2>
                        <p class="card-text">Delivered</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-truck font-medium-5">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">{{ $total_partial_delivered  ?? '0'}}</h2>
                        <p class="card-text">Partial Delivered</p>
                    </div>
                    <div class="avatar bg-light-danger p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='truck'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder  mb-0">{{ $total_parcel_cancel }}</h2>
                        <p class="card-text">Cancelled</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='truck'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder   mb-0">{{ $total_parcel_transit }}</h2>
                        <p class="card-text">In Transit</p>
                    </div>
                    <div class="avatar bg-light-success p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='play'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder   mb-0">{{ $total_parcel_hold ?? 0 }}</h2>
                        <p class="card-text">On Hold</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='pause'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder   mb-0">{{ $total_Parcel_Price??'0' }} </h2>
                        <p class="card-text">Total Parcel Price</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">{{ $total_Parcel_Price??'0' }} </h2>
                        <p class="card-text">Total Delivery Charge</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">{{ $total_Parcel_Price??'0' }} </h2>
                        <p class="card-text">Total Delivery Charge</p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder   mb-0">{{ $cash??'0' }} </h2>
                        <p class="card-text">Balance/Cash ( TK ) </p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-6 col-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h2 class="font-weight-bolder mb-0">{{ $cash_received }} </h2>
                        <p class="card-text">Balance/Cash Received ( TK ) </p>
                    </div>
                    <div class="avatar bg-light-warning p-50 m-0">
                        <div class="avatar-content">
                            <i data-feather='dollar-sign'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card text-center">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl no</th>
                                <th>City Type</th>
                                <th>Weight Range (KG)</th>
                                <th>Delivery Charge (TK)</th>
                                <th>COD (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($merchant->delivery_charges)
                            @foreach($charges as $charge)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$charge->cityType->name}}</td>
                                <td>{{$charge->weightRange->min_weight}} - {{$charge->weightRange->max_weight}}</td>
                                <td>{{$charge->delivery_charge}}</td>
                                <td>{{$charge->cod}}</td>
                            </tr>
                            @endforeach
                            @else
                            @foreach($merchant->delivery_charges as $deliveryCharge)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$deliveryCharge->cityType->name}}</td>
                                <td>{{$deliveryCharge->weightRange->min_weight}} - {{$deliveryCharge->weightRange->max_weight}}</td>
                                <td>{{$deliveryCharge->delivery_charge}}</td>
                                <td>{{$deliveryCharge->cod}}</td>
                            </tr>
                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection