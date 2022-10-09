<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\services\DeliveryReportService;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DeliveryReportController extends Controller
{
    public function show()
    {
        return view('admin.report.monthly-rider-delivery-report.show');
    }

    public function searchResult(Request $request, DeliveryReportService $service)
    {
        if ($request->ajax()) {
            $days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
            $riders = Rider::select(['id', 'name'])->latest()->get();

            $deliveryData = [];
            $dateAndTime = [
                'days'=>$days,
                'month'=>$request->month,
                'year'=>$request->year
            ];
            foreach ($riders as $rider) {
                $dailyDeliveryForSpecificRider = $service->riderWiseDailyDelivery($rider, $dateAndTime);
                array_push($deliveryData, [
                    'rider_name' => $rider->name,
                    'rider_data' => $dailyDeliveryForSpecificRider,
                ]);

            }

            $data['days'] = $days;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['deliveryData'] = $deliveryData;
            $data['total_daily_delivery'] = $service->dailyTotalDelivery($dateAndTime);

            return response()->view('admin.report.monthly-rider-delivery-report.search-result', $data);
        }
    }

    public function pdf(Request $request, DeliveryReportService $service)
    {
        $riders = Rider::select(['id', 'name'])->where(['status' => 'active'])->latest()->get();

        $deliveryData = [];

        $dateAndTime = [
            'days'=>$request->days,
            'month'=>$request->month,
            'year'=>$request->year
        ];


        foreach ($riders as $rider) {
            $dailyDeliveryForSpecificRider = $service->riderWiseDailyDelivery($rider, $dateAndTime);
            array_push($deliveryData, [
                'rider_name' => $rider->name,
                'rider_data' => $dailyDeliveryForSpecificRider,
            ]);
        }
        $data['days'] = $request->days;
        $data['month'] = $request->month;
        $data['year'] = $request->year;
        $data['deliveryData'] = $deliveryData;
        $data['total_daily_delivery'] = $service->dailyTotalDelivery($dateAndTime);

        $pdf = PDF::loadView(
            'admin.report.monthly-rider-delivery-report.pdf',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Delivery Report -' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');

    }
}
