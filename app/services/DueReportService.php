<?php

namespace App\services;

use App\Models\Admin\Rider;
use App\Models\Parcel;

class DueReportService
{
    public function getDueQueryInMerchantWise($requestData)
    {
        return Parcel::with('collection')
            ->when(!empty($requestData->date_range), function ($query) use ($requestData) {
                $dateRange = explode('to', $requestData->date_range);
                $startDate = "$dateRange[0] 00:00:00";
                $endDate = "$dateRange[1] 23:59:59";
                return $query->where(['merchant_id' => $requestData->merchant_id])->whereBetween('created_at', [$startDate, $endDate]);
            }, function ($query) use ($requestData) {
                return $query->where(['merchant_id' => $requestData->merchant_id]);
            });
    }

    public function getTotalCollectedAmountInMerchantWise($requestData)
    {
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $collectedAmount = [];
        foreach ($parcels as $q) {
            if (!empty($q->collection)) {
                array_push($collectedAmount, $q->collection->amount);
            }
        }

        return array_sum($collectedAmount);
    }

    public function getTotalDeliverChargeInMerchantWise($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $collectedDeliveryCharge = [];
        foreach ($parcels as $parcel) {
            if (!empty($parcel->collection)) {
                array_push($collectedDeliveryCharge, $parcel->collection->delivery_charge);
            }
        }

        return array_sum($collectedDeliveryCharge);
    }

    public function getTotalCODChargeInMerchantWise($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $collectedCODCharge = [];
        foreach ($parcels as $parcel) {
            if (!empty($parcel->collection)) {
                array_push($collectedCODCharge, $parcel->collection->cod_charge);
            }
        }

        return array_sum($collectedCODCharge);
    }

    public function getTotalNetPayableInMerchantWise($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $netPayable = [];
        foreach ($parcels as $parcel) {
            if (!empty($parcel->collection)) {
                array_push($netPayable, $parcel->collection->net_payable);
            }
        }

        return array_sum($netPayable);
    }

    public function getTotalNotCollectedAmount($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $notCollectedAmount = [];
        foreach ($parcels as $parcel) {
            if (empty($parcel->collection) && $parcel->status !== 'wait_for_pickup') {
                array_push($notCollectedAmount, $parcel->collection_amount);
            }
        }

        return array_sum($notCollectedAmount);
    }

    public function getTotalNotCollectedDeliveryCharge($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $notCollectedDeliveryCharge = [];
        foreach ($parcels as $parcel) {
            if (empty($parcel->collection)) {
                array_push($notCollectedDeliveryCharge, $parcel->delivery_charge);
            }
        }

        return array_sum($notCollectedDeliveryCharge);
    }

    public function getTotalNotCollectedCODCharge($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $notCollectedDeliveryCharge = [];
        foreach ($parcels as $parcel) {
            if (empty($parcel->collection)) {
                array_push($notCollectedDeliveryCharge, $parcel->cod);
            }
        }

        return array_sum($notCollectedDeliveryCharge);
    }

    public function getTotalPaidForMerchant($requestData){
        $parcels = $this->getDueQueryInMerchantWise($requestData)->latest()->get();
        $paidAmount = [];
        foreach ($parcels as $parcel) {
            if (!empty($parcel->collection)) {
                if($parcel->collection->merchant_paid === 'unpaid' || $parcel->collection->merchant_paid === 'received'){
                    array_push($paidAmount, $parcel->collection->net_payable);
                }

            }
        }
        return array_sum($paidAmount);
    }


    public function getRiderCollectionSummery(){
        return Rider::with('collections')->where(['status'=>'active'])->get();
    }

}
