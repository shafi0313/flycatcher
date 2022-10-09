<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Models\Merchant;
use App\services\DeliveryChargeReportService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\MerchantInterface;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class DeliveryChargeReportController extends Controller
{
    protected $merchant;
    public function __construct(MerchantInterface $merchant)
    {
        $this->merchant = $merchant;
    }

    public function merchantWiseDeliveryCharge()
    {
        $data['merchants'] = $this->merchant->allMerchantList();
        return view('admin.report.delivery-charge-report-merchant-wise.show', $data);
    }


    public function merchantWiseDeliveryChargeSearch(Request $request, DeliveryChargeReportService $service)
    {
        if($request->ajax()){
            $days =  cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);
            $merchants =  Merchant::select(['id', 'name'])->get();
            $deliveryChargeData = $service->getDeliveryChargeData($merchants, $days, $request->month, $request->year);
            $totalDeliveryCharge = $service->getDailyDeliveryChargeTotal($days, $request->month, $request->year);
            $data['days'] = $days;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['deliveryChargeData'] = $deliveryChargeData;
            $data['totalDeliveryCharges'] = $totalDeliveryCharge;

            return response()->view('admin.report.delivery-charge-report-merchant-wise.search-result', $data);
        }
    }

    public function merchantWiseDeliveryChargePdf(Request $request, DeliveryChargeReportService $service){
        $merchants =  Merchant::select(['id', 'name'])->get();
        $deliveryChargeData = $service->getDeliveryChargeData($merchants, $request->days, $request->month, $request->year);
        $totalDeliveryCharge = $service->getDailyDeliveryChargeTotal($request->days, $request->month, $request->year);

        $data['days'] = $request->days;
        $data['month'] = date('M', mktime(0, 0, 0, $request->month));
        $data['year'] = $request->year;
        $data['deliveryChargeData'] = $deliveryChargeData;
        $data['totalDeliveryCharges'] = $totalDeliveryCharge;

        $pdf = PDF::loadView(
            'admin.report.delivery-charge-report-merchant-wise.pdf',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Merchant Delivery Charge Report -' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');

    }
}
