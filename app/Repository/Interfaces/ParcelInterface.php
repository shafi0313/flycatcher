<?php

namespace App\Repository\Interfaces;

interface ParcelInterface
{
    /**
     * @return mixed
     */
    public function allLatestParcel($status);
    /**
     * @param $parcelId
     * @return mixed
     */
    public function getAnInstance($parcelId);

    public function getParcelDataById($parcelID);

    public function parcelDetails($parcelId, $relationModel);

    public function getMultipleInstanceById($parcelIds);
    /**
     * @param $status
     * @return mixed
     */
    public function allLatestParcelByMerchantBasis($status);

    /**
     * @param $status
     * @return mixed
     */
    public function allLatestParcelByRiderBasis($status);

    public function getAllParcelListWithCondition($condition);

    public function getAllParcelListWithSpecificDateRange($condition, $startDate, $endDate);

    /**
     * @param $requestData
     * @param $parcelData
     * @return mixed
     */
    public function updateParcel(array $requestData, $parcelData);

    public function updateMultipleParcelById($parcelIds, $requestData);

    /**
     * @param $parcelData
     * @return mixed
     */
    public function deleteParcel($parcelData);

    /**
     * @param array $parcelData
     * @return mixed
     */
    public function createParcel(array $parcelData);

    public function parcelCountInDifferentStatus($whereCondition);

    public function dailyMonthlyYearlyParcelCount($column='*', $whereCondition=[], $columnNameToFindDate='created_at', $date='');

    public function countParcelWithDateRange($whereCondition, $startDate, $endDate);

    public function countParcel($whereCondition, $dateRange = '');

    public function riderWiseParcelReport($condition, $startDate, $endDate);
}
