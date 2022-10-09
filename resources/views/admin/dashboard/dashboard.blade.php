@extends('layouts.master')

@section('title','Dashboard')
@section('content')
    <section id="dashboard-ecommerce">
        @php
            $links = [

            ]
        @endphp
        <x-bread-crumb-component title='Dashboard' :links="$links" />
        <div class="row">
        <!-- <?php phpinfo(); ?> -->
            @hasrole('Incharge')
            <div class="col-xl-4 col-md-4 col-sm-4 col-xs-12">
                <div class="card card-apply-job">
                    <div class="card-body">
                        <form action="{{route('admin.collection.incharge.transfer')}}" method="POST">
                            @csrf
                            @method('put')
                            <div class="apply-job-package bg-light-info rounded">
                                <div >
                                   <a class="badge badge-pill badge-light-info" href="{{route('admin.incharge.collection.list')}}">Collected Amount</a>
                                </div>
                                <div>
                                    <h4 class="d-inline mr-25">{{number_format($totalCollectedAmountForIncharge)}}
                                        TK</h4>
                                </div>
                            </div>
                            <div class="apply-job-package bg-light-success rounded">
                                <div class="badge badge-pill badge-light-success">Request For Transaction</div>
                                <div>
                                    <h4 class="d-inline mr-25">{{number_format($totalRequestedAmountForIncharge)}}
                                        TK</h4>
                                </div>
                            </div>
                            <input type="hidden" value="{{$totalCollectedAmountForIncharge}}">
                            <div class="form-group">
                                <select class="form-control select2" name="admin_id" id="admin_id">
                                        <option value=" ">Select One</option>
                                    @foreach($accountants as $accountant)
                                        <option value="{{$accountant->id}}">{{$accountant->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('admin_id'))
                                    <small class="text-danger">{{$errors->first('admin_id')}}</small>
                                @endif
                            </div>
                            <button type="submit"
                                    class="btn btn-primary btn-block waves-effect waves-float waves-light" {{$totalCollectedAmountForIncharge === 0 ? 'disabled': ''}}>
                                Request For Transfer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 col-md-8 col-sm-8">
                <div class="card text-center">
                    <div class="card-body">

                    </div>
                </div>
            </div>
            @endhasrole
            @hasrole('Accountant')
            <div class="col-xl-3 col-md-4 col-sm-6">
                <div class="card text-center">
                    <div class="card-body">
                        <h2 class="font-weight-bolder">{{$todayCollectedAmountForAccount}} TK</h2>
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
                        <h2 class="font-weight-bolder">{{$totalCollectedAmountForAccount}} TK</h2>
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
            @endhasrole
        </div>
    </section>
    <section>
        <div id="chartjs-chart" class="card">
{{--            <div class="row px-1 pt-1">--}}
{{--                <div class="form-group col-md-4">--}}
{{--                    <label for="month">Select Hub</label>--}}
{{--                    <select class="form-control" name="hub_id" id="hub_id">--}}
{{--                        <option value="0">All</option>--}}
{{--                        @foreach($hubs as $hub)--}}
{{--                        <option value="{{$hub->id}}">{{$hub->name}}</option>--}}
{{--                        @endforeach--}}
{{--                    </select>--}}

{{--                </div>--}}
{{--                <div class="col-md-4 form-group">--}}
{{--                    <label for="search_button"></label>--}}
{{--                    <button class="btn btn-primary waves-effect waves-float waves-light form-control" id="search_button" type="button">Search--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row" id="searchResult">--}}

            </div>
            <div class="row" id="parcelSummary">
                <div class="col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">All Parcel</h4>
                        </div>
                        <div class="card-body">
                            <canvas class="total-parcel-report total-parcel-chartjs" data-height="275"></canvas>
                            <div class="d-flex justify-content-between mt-3 mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Total</span>
                                    <span>- {{$total}}</span>
                                </div>
                                <div>
                                    <span>100%</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Wait For Pickup</span>
                                    <span>- {{$waitForPickup}}</span>
                                </div>
                                <div>
                                    <span>{{$waitForPickupPercent}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Received At Office</span>
                                    <span>- {{$receivedAtOffice}}</span>
                                </div>
                                <div>
                                    <span>{{$receivedAtOfficePercent}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Pending</span>
                                    <span>- {{$pending}}</span>
                                </div>
                                <div>
                                    <span>{{$pendingPercent}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Transit</span>
                                    <span>- {{$transit}}</span>
                                </div>
                                <div>
                                    <span>{{$transitPercent}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Dilevered</span>
                                    <span>- {{$delivered}}</span>
                                </div>
                                <div>
                                    <span>{{$deliveredPercent}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Partial</span>
                                    <span>- {{$partial}}</span>
                                </div>
                                <div>
                                    <span>{{$partialPercent}}%</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Hold</span>
                                    <span>- {{$hold}}</span>
                                </div>
                                <div>
                                    <span>{{$holdPercent}}%</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Canceled</span>
                                    <span>- {{$cancelled}}</span>
                                </div>
                                <div>
                                    <span>{{$cancelledPercent}}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 col-xs-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Daily Parcel Report</h4>
                        </div>
                        <div class="card-body">
                            <canvas class="daily-parcel-report daily-parcel-chartjs" data-height="275"></canvas>
                            <div class="d-flex justify-content-between mt-3 mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Total</span>
                                    <span>- {{$dailyTotal}}</span>
                                </div>
                                <div>
                                    <span>100%</span>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Admin Entry</span>
                                    <span>- {{$dailyParcelCreateByAdmin}}</span>
                                </div>
                                <div>
                                    <span>{{$percentDailyParcelCreatedByAdmin}}%</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <div class="d-flex align-items-center">
                                    <span class="font-weight-bold ml-75 mr-25">Merchant Entry</span>
                                    <span>- {{$dailyParcelCreateByMerchant}}</span>
                                </div>
                                <div>
                                    <span>{{$percentDailyParcelCreatedByMerchant}}%</span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-12">
                    <div class="card">
                        <div
                            class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">
                            <div class="header-left">
                                <h4 class="card-title">Latest Statistics</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    {{--    total parcel chart strart--}}
    <script>

        $(window).on('load', function () {
            'use strict';
            var chartWrapper = $('.total-parcel-chartjs'),
                doughnutChartEx = $('.total-parcel-report');
            var waitForPickup = '#B68D40',
                pending = '#FFA114',
                transit = '#145DA0',
                delivered = '#21B6A8',
                partial = '#34675C',
                cancel = '#DB1F48',
                hold = '#FF8300',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout


            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            if (chartWrapper.length) {
                chartWrapper.each(function () {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
                });
            }

            if (doughnutChartEx.length) {
                var doughnutExample = new Chart(doughnutChartEx, {
                    type: 'doughnut',
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        cutoutPercentage: 60,
                        legend: {display: false},
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var label = data.datasets[0].labels[tooltipItem.index] || '',
                                        value = data.datasets[0].data[tooltipItem.index];
                                    var output = ' ' + label + ' : ' + value + ' %';
                                    return output;
                                }
                            },
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        }
                    },
                    data: {
                        datasets: [
                            {
                                labels: ['Wait For Pickup', 'Pending', 'Transit', 'Delivered', 'Partial', 'Cancel', 'Hold'],
                                data: [
                                    {{$waitForPickupPercent}}, {{$pendingPercent}}, {{$transitPercent}}, {{$deliveredPercent}}, {{$partialPercent}}, {{$cancelledPercent}}, {{$holdPercent}}
                                ],
                                backgroundColor: [waitForPickup, pending, transit, delivered, partial, cancel, hold],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }
                        ]
                    }
                });
            }
        });

    </script>
    {{--    total parcel chart end--}}

    {{--    total parcel chart strart--}}
    <script>

        $(window).on('load', function () {
            'use strict';
            var chartWrapper = $('.daily-parcel-chartjs'),
                doughnutChartEx = $('.daily-parcel-report');
            var waitForPickup = '#B68D40',
                admin = '#FFA114',
                merchant = '#34675C',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout


            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            if (chartWrapper.length) {
                chartWrapper.each(function () {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
                });
            }

            if (doughnutChartEx.length) {
                var doughnutExample = new Chart(doughnutChartEx, {
                    type: 'doughnut',
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        cutoutPercentage: 60,
                        legend: {display: false},
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    var label = data.datasets[0].labels[tooltipItem.index] || '',
                                        value = data.datasets[0].data[tooltipItem.index];
                                    var output = ' ' + label + ' : ' + value + ' %';
                                    return output;
                                }
                            },
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        }
                    },
                    data: {
                        datasets: [
                            {
                                labels: ['Admin Entry', 'Merchant Entry'],
                                data: [
                                    {{$percentDailyParcelCreatedByAdmin}}, {{$percentDailyParcelCreatedByMerchant}}
                                ],
                                backgroundColor: [admin, merchant],
                                borderWidth: 0,
                                pointStyle: 'rectRounded'
                            }
                        ]
                    }
                });
            }
        });

    </script>
    {{--    total parcel chart end--}}


    <script>
        $(window).on('load', function () {
            'use strict';

            var chartWrapper = $('.chartjs'),
                barChartEx = $('.bar-chart-ex');


            // Color Variables
            var successColorShade = '#28dac6',
                tooltipShadow = 'rgba(0, 0, 0, 0.25)',
                labelColor = '#6e6b7b',
                grid_line_color = 'rgba(200, 200, 200, 0.2)'; // RGBA color helps in dark layout

            // Detect Dark Layout
            if ($('html').hasClass('dark-layout')) {
                labelColor = '#b4b7bd';
            }

            // Wrap charts with div of height according to their data-height
            if (chartWrapper.length) {
                chartWrapper.each(function () {
                    $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
                });
            }


            // Bar Chart
            // --------------------------------------------------------------------
            if (barChartEx.length) {
                var barChartExample = new Chart(barChartEx, {
                    type: 'bar',
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderSkipped: 'bottom'
                            }
                        },
                        responsive: true,
                        maintainAspectRatio: false,
                        responsiveAnimationDuration: 500,
                        legend: {
                            display: false
                        },
                        tooltips: {
                            // Updated default tooltip UI
                            shadowOffsetX: 1,
                            shadowOffsetY: 1,
                            shadowBlur: 8,
                            shadowColor: tooltipShadow,
                            backgroundColor: window.colors.solid.white,
                            titleFontColor: window.colors.solid.black,
                            bodyFontColor: window.colors.solid.black
                        },
                        scales: {
                            xAxes: [
                                {
                                    barThickness: 15,
                                    display: true,
                                    gridLines: {
                                        display: true,
                                        color: grid_line_color,
                                        zeroLineColor: grid_line_color
                                    },
                                    scaleLabel: {
                                        display: false
                                    },
                                    ticks: {
                                        fontColor: labelColor
                                    }
                                }
                            ],
                            yAxes: [
                                {
                                    display: true,
                                    gridLines: {
                                        color: grid_line_color,
                                        zeroLineColor: grid_line_color
                                    },
                                    ticks: {
                                        stepSize: 50,
                                        min: 0,
                                        max: 600,
                                        fontColor: labelColor
                                    }
                                }
                            ]
                        }
                    },
                    data: {


                        labels: [
                            @foreach($lastMontDates as $date)
                                '{{date('d-M', strtotime($date))}}',
                            @endforeach
                        ],
                        datasets: [
                            {
                                data: [{{$lastMontRecords}}],
                                backgroundColor: successColorShade,
                                borderColor: 'transparent'
                            }
                        ]
                    }
                });
            }

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#search_button').on('click', function() {
                let hub_id = $('#hub_id').val();
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.dashboard.parcel-summary-search-by-hub') }}",
                    data: {
                        hub_id: hub_id,
                    },
                    success: function(response) {
                        console.log(response)
                        $("#parcelSummary").hide();
                        $("#searchResult").html(response);
                    }
                });
            });
        });
    </script>
@endpush
