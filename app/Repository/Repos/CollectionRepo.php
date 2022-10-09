<?php

namespace App\Repository\Repos;

use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Repository\Interfaces\CollectionInterface;
use Illuminate\Support\Facades\DB;

class CollectionRepo implements CollectionInterface
{
    public function allLatestCollectionRiderBasis()
    {
        return Rider::with('collections')->whereHas('collections', function($q){
            $q->where(['rider_collected_status'=>'transfer_request', 'rider_collection_transfer_for'=>auth('admin')->user()->id]);
        })->latest()->get();
    }

    public function allLatestCollectionInchargeBasis()
    {
        return Collection::with(['incharge' => function ($q) {
            $q->select(['id', 'name', 'mobile']);
        }])->select(['id','amount', 'incharge_collected_status', 'incharge_collected_by'])
            ->where('incharge_collected_status', 'transfer_request')
            ->groupBy('incharge_collected_by')
            ->latest();
    }

    public function getACollectionInConditionBasis($whereCondition)
    {
        return Collection::with('parcel', 'parcel.merchant')->where($whereCondition)->first();
    }

    public function getAllCollectionInConditionBasis($whereCondition)
    {
        return Collection::with('parcel', 'parcel.merchant')->where($whereCondition)->get();
    }

    public function collectionDetailsWithCondition($relationModel, $whereCondition)
    {
        return Collection::with($relationModel)->where($whereCondition)->get();
    }

    public function allLatestCollection($whereCondition)
    {
        return Collection::with(['rider', 'parcel', 'parcel.merchant', 'incharge', 'accountant'])->where($whereCondition)->latest();
    }

    public function createCollection(array $requestData)
    {
        return Collection::create($requestData);
    }

    public function totalAmount($whereCondition, $columnName = 'amount')
    {
        return Collection::select('amount')->where($whereCondition)->sum($columnName);
    }


    public function updateCollection($whereCondition, $requestData)
    {
        return Collection::where($whereCondition)->update($requestData);
    }

    public function deleteCollection($parcelData)
    {
        return $parcelData->delete();
    }

    public function dueListWithCondition($condition)
    {
//        return DB::table('collections')
//            ->groupBy('merchant_id')
//            ->where($condition)
//            ->get();
    }
}
