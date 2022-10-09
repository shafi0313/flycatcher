@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Sheet Wise Collection')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel'=>route('admin.parcel.index'),
    'Sheet Wise Collection'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Sheet Wise Collection' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="head-label">
                                <Rider style="font-size: 20px;">Rider Name: <b>{{ $riderInfo->name }}</b> | Rider Mobile: <b>{{ $riderInfo->mobile }}</b></span>
                            </div>
                            <div class="dt-action-buttons text-right">
                                <div class="dt-buttons d-inline-flex">
                                    <a href="{{ route('admin.print-parcels.index') }}" class="btn btn-primary waves-effect waves-float waves-light mr-2">Print Sheet List</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sheet-all-hisab-accept') }}" method="POST" class="">
                                @csrf
                                <table class="table">
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Details</th>
                                        <th>Merchant Details</th>
                                        <th>Tracking ID</th>
                                        <th>Invoice ID</th>
                                        <th class="text-right">Amount (TK)</th>
                                        <th class="text-right">Collected (TK)</th>
                                        <th>Booking Date</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                    @php
                                    $total=0;
                                    $ctotal=0;
                                    @endphp
                                    @foreach($parcels as $parcel)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                            <input type="hidden" value="{{  $parcel->id }}" id="" name="parcelIds[]">
                                            <input type="hidden" value="{{  Request::segment(3) }}" id="" name="sheet_id">
                                            <input type="hidden" value="{{ $riderInfo->id }}" id="" name="rider_id">
                                        </td>
                                        <td>
                                            <p><b>Name: </b>{{$parcel->customer_name}}</p>
                                            <p><b>Mobile: </b>{{$parcel->customer_mobile}}</p>
                                        </td>
                                        <td>
                                            <p>{{$parcel->merchant->name}}</p>
                                            <p>{{$parcel->merchant->mobile}}</p>
                                        </td>
                                        <td>
                                            {{$parcel->tracking_id}}
                                        </td>
                                        <td>
                                            {{$parcel->invoice_id}}
                                        </td>
                                        <td class="text-right">
                                            <b>{{number_format($parcel->collection_amount)}}</b>
                                        </td>
                                        <td class="text-right">
                                            {{ number_format($parcel->collection->collection_amount ?? 0)}}
                                        </td>
                                        <td>
                                            {{$parcel->added_date}}
                                        </td>
                                        <td>
                                            {{ucfirst($parcel->status)}}
                                        </td>
                                        <td>
                                            @if ($parcel->delivery_status==='hold'|| $parcel->delivery_status==='partial'|| $parcel->delivery_status==='exchange'|| $parcel->delivery_status==='cancelled')
                                            <a href="{{route('admin.sheet-hisab-accept',[$parcel->delivery_status,$parcel->id,Request::segment(3)])}}" class="btn btn-success waves-effect waves-float waves-light mr-2"><i class="fa fa-check" aria-hidden="true"></i> Accept</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @php
                                    $total= $total+ $parcel->collection_amount;
                                    if(isset($parcel->collection->collection_amount)){
                                    $ctotal= $ctotal + $parcel->collection->collection_amount;
                                    }else{
                                    $ctotal= $ctotal +0;
                                    }

                                    @endphp
                                    @endforeach
                                    <tr>
                                        <td class="tr" colspan="5" style="font-weight: bold; font-size:14px;">Total</td>

                                        <td style="font-weight: bold; font-size:24px;" class="text-right">
                                            {{number_format($total)}}
                                        </td>
                                        <td style="font-weight: bold; font-size:24px;" class="text-right">
                                            {{number_format($ctotal)}}
                                        </td>
                                        <td>
                                            @if($sheetInfo->status !=='done')
                                            <button class="btn btn-success waves-effect waves-float waves-light mr-2"><i class="fa fa-check-circle" aria-hidden="true"></i>Accept Here</button>
                                            @else
                                            <p style="font-weight: bold; font-size:24px; color:#28c76f">Accepted</p>
                                            @endif
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
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

@push('script')
<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
<script>
    $(function() {
        $('input[name="daterange"]').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
        }, function(start, end, label) {
            $('input[name="daterange"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            var rider_id = $('#rider_id').val();
            var status = $('#status').val();
            var daterange = $('#daterange').val();
            if (rider_id == null) {
                alert('Please Select Rider Right Now');
            } else {

                $.ajax({

                    type: "GET",
                    url: "{{ route('admin.print-parcel-search') }}",
                    data: {
                        rider_id: rider_id,
                        status: status,
                        daterange: daterange,
                    },
                    success: function(response) {
                        console.log(response);
                        $("#searchResult").html(response);

                    }
                });
            }
        });


    });
</script>
@endpush