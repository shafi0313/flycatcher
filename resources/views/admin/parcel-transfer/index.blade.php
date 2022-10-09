@extends('layouts.master')
@section('title', 'Parcel Transfer list')
@section('content')
    <div class="content-wrapper">
        @php
            $links = [
            'Home'=>route('admin.dashboard'),
            'Parcel list'=>''
            ]
        @endphp
        <x-bread-crumb-component title='Parcel Transfer list' :links="$links" />
        <div class="content-body" id="">
            <div class="row" id="table-responsive">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="head-label">
                                <h4 class="mb-0">Parcel Info</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                <tr>
                                    <td>
                                        <p><strong>Tracking ID:</strong> {{$parcel->tracking_id}}</p>
                                        <p><strong>Tracking ID:</strong> {{$parcel->invoice_id}}</p>
                                    </td>
                                    <td>
                                        <p><strong>Customer info:</strong> {{$parcel->customer_name}} ({{$parcel->customer_mobile}})</p>
                                        <p><strong>Area:</strong> {{$parcel->sub_area->name}}</p>
                                    </td>
                                    <td>
                                        <p><strong>Merchant info:</strong> {{$parcel->merchant->name}} ({{$parcel->merchant->mobile}})</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header ">
                            <div class="head-label">
                                <h4 class="mb-0">Parcel Transfer List</h4>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table id="dataTable" class="datatables-basic table">
                               <thead>
                               <tr>
                                  <th>Current Position</th>
                                   <th></th>
                                  <th>Requested Position</th>
                                  <th>Status</th>
                                  <th>Action</th>
                               </tr>
                               </thead>
                                <tbody>
                                @foreach($parcel->parcel_transfers as $transfer)
                                <tr>
                                    <td>
                                        <p><strong>Area: </strong> {{$transfer->sub_area->name??''}}</p>
                                        <p><strong>Rider: </strong> {{$transfer->present_rider->name?? ''}} ({{$transfer->present_rider->mobile}})</p>
                                    </td>
                                    <td>
                                        <div class="line">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right font-medium-2"><polyline points="9 18 15 12 9 6"></polyline></svg>
                                        </div>
                                    </td>
                                    <td>
                                        <p><strong>Area: </strong> {{$transfer->sub_area->name??''}}</p>
                                        <p><strong>Rider: </strong> {{$transfer->rider->name??''}} ({{$transfer->rider->mobile??''}})</p>
                                    </td>
                                    <td>
                                        @if($transfer->status==='pending')
                                            <div class="badge badge-warning">{{ucfirst($transfer->status)}}</div>
                                        @elseif($transfer->status==='accept')
                                            <div class="badge badge-primary">{{ucfirst($transfer->status)}}</div>
                                        @else
                                            <div class="badge badge-danger">{{ucfirst($transfer->status)}}</div>
                                        @endif

                                    </td>
                                    <td>
                                        @if($transfer->status === 'pending')
                                            <div class="d-flex">
                                                <div class="mr-1">
                                                    <form action="{{route('admin.parcel.transfer.accept', $transfer->id)}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-success btn-sm" type="submit" title="Accept Now">
                                                            {{bladeIcon('accept')}}
                                                        </button>
                                                    </form>
                                                </div>
                                                <div class="mr-1">
                                                    <form action="{{route('admin.parcel.transfer.reject', $transfer->id)}}" method="POST">
                                                        @csrf
                                                        @method('put')
                                                        <button class="btn btn-danger btn-sm" type="submit" title="Reject It">
                                                            {{bladeIcon('delete')}}
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

