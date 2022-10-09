<?php

namespace App\services;

use App\Models\Collection;

class DeliveryChargeReportService
{
    public function getDeliveryChargeData($merchantData, $day, $month, $year){
        $deliveryChargeData  = [];
        foreach ($merchantData as $merchant){
            $merchantData = [];
            $dayToDayTotalDeliveryCharge = 0;
            for($i= 1 ; $i<= $day ; $i++){
                $deliveryCharge = Collection::select(['id','merchant_id', 'delivery_charge', 'accounts_collected_time'])->where(['merchant_id'=>$merchant->id, 'accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '=', $year.'-'.$month.'-'.$i)->sum('delivery_charge');
                $dayToDayTotalDeliveryCharge = $dayToDayTotalDeliveryCharge + $deliveryCharge;
                array_push($merchantData, [
                    'delivery_charge'=>$deliveryCharge,
                ]);
            }

            array_push($deliveryChargeData, [
                'merchant_name'=>$merchant->name,
                'merchant_data'=> $merchantData,
                'day_to_day_total_delivery_charge' =>$dayToDayTotalDeliveryCharge,
            ]);

        }

        return $deliveryChargeData;
    }

    public function getDailyDeliveryChargeTotal($day, $month, $year){
        $totalDeliveryCharge = [];
        for ($i= 1 ; $i<= $day ; $i++){
            array_push($totalDeliveryCharge, [
                'total_delivery_charge'=>Collection::select(['id','merchant_id', 'delivery_charge', 'accounts_collected_time'])->whereDate('accounts_collected_time', '=', $year.'-'.$month.'-'.$i)
                    ->where(['accounts_collected_status' => 'collected'])->sum('delivery_charge'),
            ]);
        }
        return $totalDeliveryCharge;
    }
}
