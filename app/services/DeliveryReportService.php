<?php

namespace App\services;

use App\Models\Collection;

class DeliveryReportService
{
    public function riderWiseDailyDelivery($riderInfo, $time = []){
        $dailyDeliveryForSpecificRider = [];
        for ($i = 1; $i <= $time['days']; $i++) {
            array_push($dailyDeliveryForSpecificRider, [
                'delivery' => Collection::select(['id', 'parcel_id', 'rider_collected_by', 'rider_collected_status', 'incharge_collected_time'])
                    ->with('parcel')->whereHas('parcel', function ($query) use ($riderInfo) {
                    $query->whereIn('status', ['partial', 'delivered','exchange'])->where(['assigning_by' => $riderInfo->id]);
                })->where(['rider_collected_by' => $riderInfo->id, 'rider_collected_status' => 'transferred'])
                    ->whereDate('incharge_collected_time', '=', $time['year'] . '-' . $time['month'] . '-' . $i)->count(),

            ]);
        }

        return $dailyDeliveryForSpecificRider;
    }

    public function dailyTotalDelivery($time = []){
        $dailyTotalDelivery = [];
        for ($i = 1; $i <= $time['days']; $i++) {
            array_push($dailyTotalDelivery, [
                'totalDelivery' => Collection::select(['id', 'parcel_id', 'rider_collected_by', 'rider_collected_status', 'incharge_collected_time'])
                    ->with('parcel')->whereHas('parcel', function ($query){
                        $query->whereIn('status', ['partial', 'delivered']);
                    })
                    ->where(['rider_collected_status' => 'transferred'])
                    ->whereDate('incharge_collected_time', '=', $time['year'] . '-' . $time['month'] . '-' . $i)->count(),
            ]);
        }

        return $dailyTotalDelivery;
    }
}
