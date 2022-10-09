<?php

namespace App\services;

use App\Models\Collection;
use App\Models\Expense;

class ExpenseReportService
{
    public function getAmountData($merchantData, $day, $month, $year){
        $deliveryChargeData  = [];
        foreach ($merchantData as $merchant){
            $merchantData = [];
            $dayToDayTotalDeliveryCharge = 0;
            for($i= 1 ; $i<= $day ; $i++){
                $deliveryCharge = Expense::select(['id','expense_head_id', 'amount', 'created_at'])->where(['expense_head_id'=>$merchant->id])->whereDate('created_at', '=', $year.'-'.$month.'-'.$i)->sum('amount');
                $dayToDayTotalDeliveryCharge = $dayToDayTotalDeliveryCharge + $deliveryCharge;
                array_push($merchantData, [
                    'delivery_charge'=>$deliveryCharge,
                ]);
            }

            array_push($deliveryChargeData, [
                'merchant_name'=>$merchant->title,
                'merchant_data'=> $merchantData,
                'day_to_day_total_delivery_charge' =>$dayToDayTotalDeliveryCharge,
            ]);

        }

        return $deliveryChargeData;
    }

    public function getDailyAmountTotal($day, $month, $year){
        $totalDeliveryCharge = [];
        for ($i= 1 ; $i<= $day ; $i++){
            array_push($totalDeliveryCharge, [
                'total_amount'=>Expense::select(['id','expense_head_id', 'amount', 'created_at'])->whereDate('created_at', '=', $year.'-'.$month.'-'.$i)->sum('amount'),
            ]);
        }
        return $totalDeliveryCharge;
    }
}
