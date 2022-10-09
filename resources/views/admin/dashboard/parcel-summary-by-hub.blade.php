<div class="col-md-3 col-xs-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">All Parcel</h4>
        </div>
        <div class="card-body">
            <canvas class="total-parcel-reportss total-parcel-chartjsgg" data-height="275"></canvas>
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


{{--<div class="col-md-3 col-xs-12">--}}
{{--    <div class="card">--}}
{{--        <div class="card-header">--}}
{{--            <h4 class="card-title">Daily Parcel Report</h4>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <canvas class="daily-parcel-report daily-parcel-chartjs" data-height="275"></canvas>--}}
{{--            <div class="d-flex justify-content-between mt-3 mb-1">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <span class="font-weight-bold ml-75 mr-25">Total</span>--}}
{{--                    <span>- {{$dailyTotal}}</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <span>100%</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="d-flex justify-content-between mb-1">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <span class="font-weight-bold ml-75 mr-25">Admin Entry</span>--}}
{{--                    <span>- {{$dailyParcelCreateByAdmin}}</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <span>{{$percentDailyParcelCreatedByAdmin}}%</span>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="d-flex justify-content-between mb-1">--}}
{{--                <div class="d-flex align-items-center">--}}
{{--                    <span class="font-weight-bold ml-75 mr-25">Merchant Entry</span>--}}
{{--                    <span>- {{$dailyParcelCreateByMerchant}}</span>--}}
{{--                </div>--}}
{{--                <div>--}}
{{--                    <span>{{$percentDailyParcelCreatedByMerchant}}%</span>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

{{--<div class="col-xl-6 col-12">--}}
{{--    <div class="card">--}}
{{--        <div--}}
{{--            class="card-header d-flex justify-content-between align-items-sm-center align-items-start flex-sm-row flex-column">--}}
{{--            <div class="header-left">--}}
{{--                <h4 class="card-title">Latest Statistics</h4>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="card-body">--}}
{{--            <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


{{--    total parcel chart strart--}}
<script>

    $(window).on('load', function () {
        'use strict';
        var chartWrapper = $('.total-parcel-chartjsgg'),
            doughnutChartEx = $('.total-parcel-reportss');
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

