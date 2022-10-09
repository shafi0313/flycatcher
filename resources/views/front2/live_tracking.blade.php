@extends('front.master')
@section('content')

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="table table-striped table-bordered">
                <tr>
                    <th>Booking Date</th>
                    <td>{{ \Carbon\Carbon::parse($parcel->added_date)->format('d-M-Y') }}</td>
                </tr>
                {{-- <tr>
                    <th>Booking From</th>
                    <th>Item Description</th>
                </tr> --}}
                <tr>
                    <th>Item</th>
                    <td>{{ $parcel->parcelType->name }}</td>
                </tr>
                <tr>
                    <th>Destination</th>
                    <td>{{ $parcel->sub_area->name }}, {{ $parcel->area->area_name }}</td>
                </tr>
                <tr>
                    <th>Receiver Contact</th>
                    <td>****{{ substr($parcel->customer_mobile, -4) }}</td>
                </tr>
                <tr>
                    <th>Note</th>
                    <th>{{ $parcel->note }}</th>
                </tr>
            </table>
        </div>
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tracking Id</th>
                        <th>Invoice Id</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Delivery Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $parcel->tracking_id }}</td>
                        <td>{{ $parcel->invoice_id }}</td>
                        <td>{{ ucfirst($parcel->payment_status) }}</td>
                        <td>{{ ucfirst(Str::replace('_', ' ',$parcel->status)) }}</td>
                        <td>{{ ucfirst(Str::replace('_', ' ',$parcel->delivery_status)) }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>

@endsection
