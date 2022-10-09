@extends('merchant.layouts.master')
@section('title', 'Parcel Cancel list')

@section('content')
    <div class="content-wrapper">
        @php
            $links = [
                'Home'=>route('admin.dashboard'),
                'Parcel Cancel list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel Cancel List' :links="$links"/>
        <div class="content-body">
            <!-- Responsive tables start -->
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            @if($number_of_records > 0)
                                <form action="{{route('merchant.accept-cancel-parcel.cancel')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <table id="dataTable" class="datatables-basic table table-bordered table-warning table-striped">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>Customer Details</th>
                                            <th>Tracking Id</th>
                                            <th>Invoice ID</th>
                                            <th>Payment Details</th>
                                            <th>Reason</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($parcels as $parcel)
                                            <tr>
                                                <td>
                                                    <input class="checkSingle" style="width: 20px; height: 20px;"
                                                           type="checkbox" value="{{$parcel->id}}" id="" name="parcelIds[]"
                                                           checked>
                                                </td>
                                                <td>
                                                    <p><b>Name:</b> {{$parcel->customer_name}}</p>
                                                    <p><b>Mobile:</b> {{$parcel->customer_mobile}}</p>
                                                    <p><b>Sub Area:</b> {{$parcel->sub_area->name}}</p>
                                                    <p><b>Address:</b> {{$parcel->customer_address}}</p>
                                                </td>
                                                <td><a href="{{route('merchant.parcel.show', $parcel->id)}}" target="_blank">{{$parcel->tracking_id}}</a></td>
                                                <td>{{$parcel->invoice_id}}</td>
                                                <td>
                                                    <p><b>Parcel Price:</b> {{number_format($parcel->collection_amount)}}
                                                    </p>
                                                    <p><b>Delivery Charge:</b> {{number_format($parcel->delivery_charge)}}
                                                    </p>
                                                    <p><b>COD Charge:</b> {{number_format($parcel->cod)}}</p>
                                                    <p><b>Payable:</b> {{number_format($parcel->payable)}}</p>
                                                </td>
                                                <td>
                                                   {{$parcel->reason->reason_type->name ?? ''}}
                                                </td>
                                                <td>
                                                    @if(! $parcel->notes->isEmpty())
                                                        <div class="mr-1">
                                                            <div class="form-modal-ex">
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                                        data-target="#showNote-{{$parcel->id}}" title="Show Notes"><i class="fa fa-bars"></i>
                                                                </button>
                                                                <!-- Modal -->
                                                                <div class="modal fade text-left" id="showNote-{{$parcel->id}}" tabindex="-1" role="dialog"
                                                                     aria-labelledby="myModalLabel33" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                                        <div class="modal-content p-1">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title" id="myModalLabel33">Parcel note</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <table class="table table-bordered">
                                                                                <thead>
                                                                                <tr>
                                                                                    <td>SL no</td>
                                                                                    <td>Noted By</td>
                                                                                    <td>Note</td>
                                                                                    <td>Date</td>
                                                                                </tr>
                                                                                </thead>

                                                                                <tbody>
                                                                                @foreach($parcel->notes as $note)
                                                                                    <tr>
                                                                                        <td>{{$loop->iteration}}</td>
                                                                                        <td>
                                                                                            @if($note->guard_name === 'admin')
                                                                                                {{$note->admin->name ?? ''}} ({{$note->guard_name}})
                                                                                            @elseif($note->guard_name === 'merchant')
                                                                                                {{$note->merchant->name ?? ''}} ({{$note->guard_name}})
                                                                                            @elseif($note->guard_name === 'rider')
                                                                                                {{$note->rider->name ?? ''}}
                                                                                            @endif

                                                                                        </td>
                                                                                        <td>{{$note->note}}</td>
                                                                                        <td>{{$note->created_at->format('d:M Y')}}, {{$note->created_at->format('h:i A')}}</td>
                                                                                    </tr>
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    <button class="btn btn-block btn-primary" type="submit">Accept Now</button>
                                </form>
                            @else
                                <div class="alert alert-danger" role="alert">
                                    <h4 class="alert-heading">Record Not found</h4>
                                    <div class="alert-body">
                                        Sorry No records found
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- Responsive tables end -->
        </div>
    </div>
@endsection


