<?php

namespace App\Repository\Interfaces;

interface CollectionInterface
{
    public function allLatestCollectionRiderBasis();

    public function allLatestCollectionInchargeBasis();

    public function getACollectionInConditionBasis($whereCondition);

    public function getAllCollectionInConditionBasis($whereCondition);

    public function collectionDetailsWithCondition($relationModel, $whereCondition);

    public function allLatestCollection($whereCondition);

    public function createCollection(array $requestData);

    public function totalAmount($whereCondition, $columnName);

    public function updateCollection($whereCondition, $requestData);

    public function deleteCollection($parcelData);

    public function dueListWithCondition($condition);
}
