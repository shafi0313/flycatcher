<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Merchant;
use App\services\DeliveryChargeReportService;
use Illuminate\Http\Request;

class MonthlyCollectionReportController extends Controller
{
    public function show()
    {
        return view('admin.report.monthly-collection.show');
    }

    protected function getCollectionQuery($condition, $dayMonthYear, $iterationNumber){
        return Collection::select(['id','merchant_id', 'amount', 'delivery_charge', 'cod_charge', 'net_payable', 'accounts_collected_time', 'accounts_collected_status', 'merchant_paid'])
            ->where($condition)
            ->whereDate('accounts_collected_time', '=', $dayMonthYear['year'].'-'.$dayMonthYear['month'].'-'.$iterationNumber);
    }

//    protected function monthlyTotalCollectionAmount(){
//        return [
//            'day_to_day_total_delivery_charge'=>
//        ];
//    }

    protected function getMonthlyCollectionData($merchantData, $dayMonthYear = []){
        $deliveryChargeData  = [];
        foreach ($merchantData as $merchant){
            $merchantData = [];
            $dayToDayTotalCollection = 0;
            $dayToDayTotalDeliveryCharge = 0;
            $dayToDayTotalMerchantPayable = 0;
            $dayToDayTotalMerchantPaid = 0;

            for($i= 1 ; $i<= $dayMonthYear['day'] ; $i++){
                $totalCollection = $this->getCollectionQuery(['merchant_id'=>$merchant->id, 'accounts_collected_status' => 'collected'], $dayMonthYear, $i)->sum('amount');
                $deliveryCharge = $this->getCollectionQuery(['merchant_id'=>$merchant->id, 'accounts_collected_status' => 'collected'], $dayMonthYear, $i)->sum('delivery_charge');
                $merchantPayable = $this->getCollectionQuery(['merchant_id'=>$merchant->id, 'accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'], $dayMonthYear, $i)->sum('net_payable');
                $merchantPaid = $this->getCollectionQuery(['merchant_id'=>$merchant->id, 'accounts_collected_status' => 'collected'], $dayMonthYear, $i)->whereIn('merchant_paid', ['paid', 'received'])->sum('net_payable');

                $dayToDayTotalCollection = $dayToDayTotalCollection + $totalCollection;
                $dayToDayTotalDeliveryCharge = $dayToDayTotalDeliveryCharge + $deliveryCharge;
                $dayToDayTotalMerchantPayable = $dayToDayTotalMerchantPayable + $merchantPayable;
                $dayToDayTotalMerchantPaid = $dayToDayTotalMerchantPaid + $merchantPaid;

                array_push($merchantData, [
                    'total_collection'=>$totalCollection,
                    'delivery_charge'=>$deliveryCharge,
                    'merchant_payable'=>$merchantPayable,
                    'merchant_paid'=>$merchantPaid
                ]);
            }

            array_push($deliveryChargeData, [
                'merchant_name'=>$merchant->name,
                'merchant_data'=> $merchantData,
                'day_to_day_total_collection' =>$dayToDayTotalCollection,
                'day_to_day_total_delivery_charge' =>$dayToDayTotalDeliveryCharge,
                'day_to_day_total_merchant_payable' =>$dayToDayTotalMerchantPayable,
                'day_to_day_total_merchant_paid' =>$dayToDayTotalMerchantPaid,
            ]);

        }

        return $deliveryChargeData;
    }

//    protected function getTotalCollectionsQuery($condition, $dayMonthYear, $iterationNumber){
//        return Collection::select(['id','merchant_id', 'amount', 'delivery_charge', 'cod_charge', 'net_payable', 'accounts_collected_time', 'accounts_collected_status', 'merchant_paid'])->where($condition)
//            ->whereDate('accounts_collected_time', '=', $dayMonthYear['year'].'-'.$dayMonthYear['month'].'-'.$iterationNumber);
//    }

    protected function getTotalCollection($dayMonthYear){
        $totalCollection = [];
        for ($i= 1 ; $i<= $dayMonthYear['day'] ; $i++){
            array_push($totalCollection, [
                'total_collection'=>$this->getCollectionQuery(['accounts_collected_status' => 'collected'], $dayMonthYear, $i)->sum('amount'),
                'total_delivery_charge'=>$this->getCollectionQuery(['accounts_collected_status' => 'collected'], $dayMonthYear, $i)->sum('delivery_charge'),
                'total_merchant_payable'=>$this->getCollectionQuery(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'], $dayMonthYear, $i)->sum('net_payable'),
                'total_merchant_paid'=>$this->getCollectionQuery(['accounts_collected_status' => 'collected'], $dayMonthYear, $i)->whereIn('merchant_paid', ['paid', 'received'])->sum('net_payable'),
            ]);
        }
        return $totalCollection;
    }

    public function searchResult(Request $request, DeliveryChargeReportService $service)
    {
        if ($request->ajax()) {
            $days =  cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);
            $merchants =  Merchant::select(['id', 'name'])->get();
            $deliveryChargeData = $this->getMonthlyCollectionData($merchants, [
                'day'=>$days,
                'month'=>$request->month,
                'year'=>$request->year
            ]);

            $data['days'] = $days;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['deliveryChargeData'] = $deliveryChargeData;
            $data['totalDeliveryCharges'] = $this->getTotalCollection([
                'day'=>$days,
                'month'=>$request->month,
                'year'=>$request->year
            ]);

            return response()->view('admin.report.monthly-collection.search-result', $data);
        }
    }
}
