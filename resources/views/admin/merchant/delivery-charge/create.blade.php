@extends('layouts.master')
@section('title', 'Delivery Charge Add')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Merchant list'=>route('admin.merchant.index'),
    'Delivery charge create'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Delivery charge create' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Merchant Information</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr class="">
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Area</th>
                                </tr>
                                <tr>
                                    <td>{{ $merchantInfo->name }}</td>
                                    <td>{{ $merchantInfo->mobile }}</td>
                                    <td>{{ $merchantInfo->area->area_name }}</td>
                                   
                               
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Delivery Charge Setup</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.merchant.delivery.charge.store', $merchantInfo->id)}}" method="POST" class="">
                                @csrf
                                @include('admin.partials.create-delivery-charge')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection