@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Cash Summary Details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Cash Summary List'=>route('admin.expense.index'),
    'Cash Summary Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Cash Summary' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Cash Summary')}}</h4>
                        </div>
                        <div class="dt-action-buttons text-right">
                            <div class="dt-buttons d-inline-flex">
                                <a href="{{route('admin.cash.summary.print')}}" class="btn btn-primary" target="_blank">{{__('Print Now')}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-secondary table-striped">
                            <tbody>
                                <tr class="table-success">
                                    <th>Total Collection</th>
                                    <th  class="text-right">{{ number_format($totalCollection) }} TK</th>
                                </tr>
                                <tr class="table-primary">
                                    <th class="">Merchant Paid</th>
                                    <th class="text-right">{{ number_format($merchant_paid) }} TK</th>
                                </tr>

                                <tr class="table-warning">
                                    <th>Delivery Charge <span class="text-primary font-weight-bolder">(+)</span></th>
                                    <th  class="text-right">{{ number_format($totalDeliveryCharge) }} TK</th>
                                </tr>
                                <tr>
                                    <td>Loan <span class="text-primary font-weight-bolder">(+)</span></td>
                                    <td  class="text-right">{{ number_format($loan) }} TK</td>
                                </tr>
                                <tr>
                                    <td>Advance <span class="text-danger font-weight-bolder">(-)</span></td>
                                    <td  class="text-right">{{ number_format($advance) }} TK</td>
                                </tr>
                                <tr>
                                    <td>Expense <span class="text-danger font-weight-bolder">(-)</span></td>
                                    <td  class="text-right">{{ number_format($expense) }} TK</td>
                                </tr>
                                <tr>
                                    <td>Bad Debt <span class="text-danger font-weight-bolder">(-)</span></td>
                                    <td  class="text-right">{{ number_format($badDebt) }} TK</td>
                                </tr>
                                <tr class="table-danger">
                                    <th>Cancle Collection Amount <span class="text-primary font-weight-bolder">(+)</span></th>
                                    <th  class="text-right">{{ number_format($totalcancleAmount) }} TK</th>
                                </tr>

                                <tr class="table-success">
                                    <td><b>Cash in Hand Without Merchant Payable</b> </td>
                                    <td  class="text-right">
                                        <b>{{number_format($totalDeliveryCharge - ($advance + $expense + $badDebt) + $loan)}}</b> TK
                                    </td>
                                </tr>
                                <tr class="table-warning">
                                    <th class="text-danger">Merchant Payable <span class="text-primary font-weight-bolder">(+)</span></th>
                                    <th class="text-danger text-right">{{ number_format($merchant_payable) }} TK</th>
                                </tr>

                                <tr class="table-primary">
                                    <td><b>Cash in Hand</b> </td>
                                    <td  class="text-right">
                                        <b>{{number_format($totalDeliveryCharge - ($advance + $expense + $badDebt) + $merchant_payable + $loan+$totalcancleAmount)}}</b> TK
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Search Cash Summary</h4>
                            </div>
                            <div class="card-body">
                                <form action="" method="POST" class="">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group">
                                            <label for="date_range">Date Range</label>
                                            <input type="text" id="date_range" class="form-control flatpickr-range" name="date_range" placeholder="YYYY-MM-DD to YYYY-MM-DD" autocomplete="off">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="search_button"></label>
                                            <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="button">Search
                                            </button>
                                        </div>
                                    </div>
                                </form>

                                <div id="searchResult"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Responsive tables end -->
    </div>
</div>
@endsection
@push('script')
<script src="{{asset('admin/app-assets/js/moment.min.js')}}"></script>
<script src="{{asset('admin/app-assets/js/daterangepicker.js')}}"></script>
<script>
    $(function() {
        $('input[name="date_range"]').daterangepicker({
            opens: 'left',
            autoUpdateInput: false,
        }, function(start, end, label) {
            $('input[name="date_range"]').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });
</script>

<script>
    $(document).ready(function() {

        $('#search_button').on('click', function() {
            let date_range = $('#date_range').val();
            $.ajax({
                type: "GET",
                url: "{{ route('admin.cash.summary.search') }}",
                data: {
                    date_range: date_range,
                },
                success: function(response) {
                    console.log(response)
                    $("#searchResult").html(response);
                }
            });
        });
    });
</script>
@endpush