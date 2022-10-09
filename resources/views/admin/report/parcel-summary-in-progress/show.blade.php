@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Parcel Summary')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Parcel Summary'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Progress Report' :links="$links" />
    <div class="content-body">
        <!-- Basic Inputs start -->
        <section id="basic-input">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <?php
                            $totalInRider = $pendingInRider + $transitInRider + $transferInRider + $holdInRider + $partialInRider + $exchangeInRider + $cancelledInRider;
                            $totalInOffice = $receivedInOffice + $exchangeInOffice + $holdInOffice + $partialInOffice + $cancelInOffice;
                            ?>
                            <h4 class="card-title">Total Processing Parcel = {{ $totalInRider + $totalInOffice }}</h4>
                            <a target="_blank" class="d-flex btn btn-sm btn-primary" href="{{ route('admin.rider-wise-parcel') }}">Rider Wise Parcel</a>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card-body">
                                    <table class="table table-bordered table-secondary table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="text-center">
                                                    <h3 class="float-left">In Office</h3>
                                                    <a href="{{route('admin.parcel.summary.in.office.pdf')}}" target="_blank"><button class="btn btn-sm btn-primary waves-effect waves-float waves-light float-right" type="submit">Print</button></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <b>New Entry In Office</b>
                                                </td>
                                                <td class="text-center">{{$receivedInOffice}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['received_at_office','processing',''])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click Here See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Hold Received In Office</b>
                                                </td>
                                                <td class="text-center">{{$holdInOffice}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['hold_accept_by_incharge','hold_accept_by_incharge',''])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Partial Received In Office</b>
                                                </td>
                                                <td class="text-center">{{$partialInOffice}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['partial','partial_accept_by_incharge','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Exchange Received In Office</b>
                                                </td>
                                                <td class="text-center">{{$exchangeInOffice}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['exchange','exchange_accept_by_incharge','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Cancelled Received In Office</b>
                                                </td>
                                                <td class="text-center">{{$cancelInOffice}}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['cancelled','cancel_accept_by_incharge','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td class="text-center">{{$totalInOffice}}</td>
                                                <td class="text-center"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <table class="table table-bordered table-secondary table-striped">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="text-center">
                                                    <h3 class="float-left">In Rider</h3>
                                                    <a href="{{route('admin.parcel.summary.in.rider.pdf')}}" target="_blank"><button class="btn btn-sm btn-primary waves-effect waves-float waves-light float-right" type="submit">Print</button></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>
                                                    Pending
                                                </th>
                                                <td class="text-center">{{ $pendingInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['pending','processing',NULL])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>

                                                    Transit
                                                </th>
                                                <td class="text-center">{{ $transitInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['transit','processing',NULL])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>

                                                    Transfer
                                                </th>
                                                <td class="text-center">{{ $transferInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['transfer','processing',NULL])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <b>Hold In Rider</b>
                                                </td>
                                                <td class="text-center">{{ $holdInRider }}</td>

                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['hold','hold',''])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <b>Partial In Rider</b>
                                                </td>
                                                <td class="text-center">{{ $partialInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['partial','partial','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <b>Exchange In Rider</b>
                                                </td>
                                                <td class="text-center">{{ $exchangeInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['exchange','exchange','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                    <b>Cancelled In Rider</b>
                                                </td>
                                                <td class="text-center">{{ $cancelledInRider }}</td>
                                                <td class="text-center">
                                                    <a class="btn btn-sm btn-primary" href="{{route('admin.parcel.summary.progress.details',['cancelled','cancelled','no'])}}" target="_blank" data-toggle="tooltip" data-placement="right" title="Click See Details">
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Total</th>
                                                <td class="text-center">{{ $totalInRider }}</td>
                                                <td class="text-center">
                                                 
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- Basic Inputs end -->
    </div>
</div>

@endsection

{{--@push('script')--}}
{{--<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>--}}
{{--<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>--}}
{{--<script>--}}
{{-- $(function() {--}}
{{-- $('input[name="date_range"]').daterangepicker({--}}
{{-- opens: 'left'--}}
{{-- }, function(start, end, label) {--}}
{{-- console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));--}}
{{-- });--}}
{{-- });--}}
{{--</script>--}}

{{--<script>--}}
{{-- $(document).ready(function() {--}}

{{-- $('#search_button').on('click', function() {--}}
{{-- let date_range = $('#date_range').val();--}}
{{-- $.ajax({--}}
{{-- type: "GET",--}}
{{-- url: "{{ route('admin.parcel.summary.search') }}",--}}
{{-- data: {--}}
{{-- date_range: date_range,--}}
{{-- },--}}
{{-- success: function(response) {--}}
{{-- console.log(response)--}}
{{-- $("#searchResult").html(response);--}}
{{-- }--}}
{{-- });--}}
{{-- });--}}
{{-- });--}}
{{--</script>--}}
{{--@endpush--}}


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
            let daterange = $('#daterange').val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.parcel.summary.search') }}",
                data: {
                    dateRange: daterange
                },
                success: function(response) {
                    $("#searchResult").html(response);
                }

            });
        });
    });
</script>
@endpush