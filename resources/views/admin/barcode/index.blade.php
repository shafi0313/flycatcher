@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Barcode')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel List'=>route('admin.parcel.index'),
    'Barcode'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Barcode' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Barcode')}}</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Merchant</th>
                                    <td>
                                        <p>
                                            <b>{{$parcel->merchant->name?? ''}}</b><br>
                                            {{$parcel->merchant->email?? ''}} <br>
                                            <b> {{$parcel->merchant->mobile?? ''}}</b>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Customer</th>
                                    <td>
                                        <p> <b>{{$parcel->customer_name?? ''}}</b><br>
                                            {{$parcel->customer_address?? ''}}<br>
                                            <b> {{$parcel->customer_mobile?? ''}}</b>
                                        </p>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td style="border-top: none!important;">
                                                        <div>
                                                            {!! DNS2D::getBarcodeHTML($parcel->tracking_id, 'QRCODE') !!}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="border-top: none!important;">
                                                        <span class="remote-data" id="supplier_due"></span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table">
                                            <tbody>

                                                <tr>
                                                    <th>Cash Collection:</th>
                                                    <td>
                                                        <b>
                                                            {{$parcel->collection_amount}} TK
                                                        </b>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Invoice ID:</th>
                                                    <td>
                                                        {{$parcel->invoice_id}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Traking ID:</th>
                                                    <td>
                                                        {{$parcel->tracking_id}}
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div style="margin-left: 120px;">
                                                            {!! DNS1D::getBarcodeHTML($parcel->tracking_id, 'C39'); !!}
                                                        </div>
                                                        <p class="text-center">
                                                            {{$parcel->tracking_id}}
                                                        </p>

                                                    </td>
                                                </tr>

                                            </tbody>

                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-gray">
                                <tr>
                                    <th>
                                        Note:
                                    </th>
                                    <td>
                                        {{ $parcel->note?? "NULL" }}
                                    </td>

                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@push('script')


@endpush