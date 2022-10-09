<?php

namespace App\Repository\Repos;

use App\Models\Parcel;
use App\Repository\Interfaces\ParcelInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;

class ParcelRepo implements ParcelInterface
{
    public function allLatestParcel($status = '')
    {
        if (!empty($status)) {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType', 'parcel_transfers','notes', 'notes.admin','notes.merchant','notes.rider' ])->where(['status' => $status])->latest();
        } else {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType', 'parcel_transfers' , 'notes', 'notes.admin','notes.merchant','notes.rider'])->whereNotIn('status', ['wait_for_pickup'])->latest();
        }

    }

    public function allLatestParcelByMerchantBasis($status)
    {
        if (!empty($status)) {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType' , 'notes', 'notes.admin','notes.merchant','notes.rider'])->where(['status' => $status, 'merchant_id' => auth('merchant')->user()->id])->latest();
        } else {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType' , 'notes', 'notes.admin','notes.merchant','notes.rider'])->where(['merchant_id' => auth('merchant')->user()->id])->latest();
        }
    }


    public function allLatestParcelByRiderBasis($status)
    {
        if (!empty($status)) {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType' , 'notes', 'notes.admin','notes.merchant','notes.rider'])->where(['status' => $status, 'assigning_by' => auth('rider')->user()->id])->latest();
        } else {
            return Parcel::with(['cityType', 'rider', 'area', 'sub_area', 'merchant', 'weightRange', 'parcelType' , 'notes', 'notes.admin','notes.merchant','notes.rider'])->where(['assigning_by' => auth('rider')->user()->id])->whereNotIn('status', ['wait_for_pickup','received_at_office'])->latest();
        }
    }

    /**
     * @param $parcelId
     * @return mixed
     */
    public function getAnInstance($parcelId)
    {
        return Parcel::with('cityType', 'rider', 'area', 'merchant', 'merchant.merchant_active_mobile_bankings', 'weightRange', 'parcelType', 'merchant.area', 'merchant.delivery_charges', 'reason.reason_type', 'created_by_admin', 'created_by_merchant', 'times', 'mobile_banking_collection', 'mobile_banking_collection.mobile_banking', 'mobile_banking_collection.merchant_mobile_banking', 'notes')->findOrFail($parcelId);
    }

    public function getParcelDataById($parcelID)
    {
        return Parcel::findOrFail($parcelID);
    }

    public function parcelDetails($parcelId, $relationModel)
    {
        return Parcel::with($relationModel)->findOrFail($parcelId);
    }

    public function getMultipleInstanceById($parcelIds)
    {
        return Parcel::whereIn('id', $parcelIds)->get();
    }

    public function getAllParcelListWithCondition($condition)
    {
        return Parcel::with(['cityType', 'rider', 'area', 'merchant', 'weightRange', 'parcelType'])->where($condition)->get();
    }

    public function getAllParcelListWithSpecificDateRange($condition, $startDate, $endDate)
    {
        return Parcel::with(['cityType', 'rider', 'area', 'merchant', 'weightRange', 'parcelType'])->where($condition)->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
    }

    /**
     * @param $requestData
     * @param $parcelData
     * @return mixed
     */
    public function updateParcel($requestData, $parcelData)
    {
        return $parcelData->update($requestData);
    }

    public function updateMultipleParcelById($parcelIds, $requestData)
    {
        return Parcel::whereIn('id', $parcelIds)->update($requestData);;
    }

    /**
     * @param $parcelData
     * @return mixed
     */
    public function deleteParcel($parcelData)
    {
        return $parcelData->delete();
    }

    public function createParcel($parcelData)
    {
        return Parcel::create($parcelData);
    }

    public function parcelCountInDifferentStatus($whereCondition = '')
    {
        if ($whereCondition == '') {
            return Parcel::count();
        } else {
            return Parcel::where($whereCondition)->count();
        }
    }

    public function dailyMonthlyYearlyParcelCount($column = '*', $whereCondition = [], $columnNameToFindDate = 'created_at', $date = '')
    {
        return Parcel::select($column)->where($whereCondition)->whereDate($columnNameToFindDate, $date)->count();
    }

    public function countParcelWithDateRange($whereCondition, $startDate, $endDate)
    {
        return Parcel::where($whereCondition)->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count();
    }

    public function countParcel($whereCondition, $dateRange = ''){
        if($dateRange == ''){
            return Parcel::where($whereCondition)->count();
        }else{
            $dateRange = explode('to', $dateRange);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";
            return Parcel::where($whereCondition)->whereBetween('created_at', [$startDate, $endDate])->count();
        }
    }

    public function riderWiseParcelReport($condition, $startDate = '', $endDate = '')
    {
        return Parcel::with(['cityType', 'rider', 'area', 'merchant', 'weightRange', 'parcelType'])
            ->when(($startDate === '' && $endDate === ''),
                function ($query) use ($condition){
                    $query->where($condition);
                },
                function ($query) use ($condition, $startDate, $endDate){
                    $query->where($condition)->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"]);
                })->get();
        //return Parcel::with(['cityType', 'rider', 'area', 'merchant', 'weightRange', 'parcelType'])->where($condition)->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
    }
}
