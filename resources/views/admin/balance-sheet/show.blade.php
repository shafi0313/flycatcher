@extends('layouts.master')
@push('style')
<link rel="stylesheet" type="text/css" href="{{asset('admin/app-assets/css/daterangepicker.css')}}">
@endpush
@section('title', 'Balance Sheet Details')
@section('content')
<div class="content-wrapper">
    @php
    $links = [
    'Home'=>route('admin.dashboard'),
    'Balance Sheet List'=>route('admin.expense.index'),
    'Balance Sheet Details'=>''
    ]
    @endphp
    <x-bread-crumb-component title='Balance Sheet' :links="$links" />
    <div class="content-body">
        <!-- Responsive tables start -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <div class="head-label">
                            <h4 class="mb-0">{{__('Balance Sheet')}}</h4>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Liability</th>
                                    <th>Assets</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th style="border-top: none!important;">Loan:</th>
                                                    <td style="border-top: none!important;">
                                                        <span class="remote-data" id="supplier_due">{{ $totalLoan }}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th style="border-top: none!important;">Expense:</th>
                                                    <td style="border-top: none!important;">
                                                        <span class="remote-data" id="supplier_due">{{ $totalExpense  }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table" id="assets_table">
                                            <tbody>
                                                <tr>
                                                    <th>Investment:</th>
                                                    <td>
                                                        <span class="remote-data" id="closing_stock">{{$totalInvestment}}</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Cash:</th>
                                                    <td>
                                                        <span class="remote-data" id="closing_stock">{{$totalDeliveryCharge}}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th>Advance:</th>
                                                    <td>
                                                        <span class="remote-data" id="customer_due">{{$totalAdvance}}</span>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <th colspan="2">Account Balances:</th>
                                                </tr>
                                            </tbody>
                                            <tbody id="account_balances" class="pl-20-td">
                                                <tr>
                                                    <td class="pl-20-td">ParcelSheba - Main Account:</td>
                                                    <td><input type="hidden" class="asset" value="$ 10,817.50">{{ $mainAccount=0 }}</td>
                                                </tr>
                                               
                                            </tbody>

                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-gray">
                                <tr>
                                    <td>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Total Liability:
                                                    </th>
                                                    <td>
                                                        <span id="total_liabilty">{{ $totalLoan + $totalExpense }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                    <td>
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>
                                                        Total Assets:
                                                    </th>
                                                    <td>
                                                        <span id="total_assets">{{ $totalDeliveryCharge + $totalAdvance+ $mainAccount }}</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
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