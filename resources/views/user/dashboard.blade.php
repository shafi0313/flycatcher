@extends('user.layouts.master')
@section('title','Dashboard')
@section('content')

<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$todayCollectedAmountForAccount ?? 0}} TK</h2>
                    <p class="card-text">Today Collected Amount</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center bg-light-danger">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$todayNetPayableForAccount ?? 0}} TK</h2>
                    <p class="card-text">Today Payable</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$todayDeliveryChargeForAccount ?? 0}} TK</h2>
                    <p class="card-text">Today Delivery Charge</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$todayCodForAccount ?? 0}} TK</h2>
                    <p class="card-text">Today COD Charge</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$totalCollectedAmountForAccount ?? 0}} TK</h2>
                    <p class="card-text">Total Collected Amount</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center bg-light-danger">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$totalNetPayableForAccount ?? 0}} TK</h2>
                    <p class="card-text">Total Payable</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$totalDeliveryChargeForAccount ?? 0}} TK</h2>
                    <p class="card-text">Total Delivery Charge</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-4 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="font-weight-bolder">{{$totalCodForAccount ?? 0}} TK</h2>
                    <p class="card-text">Total COD Charge</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection