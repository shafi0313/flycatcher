<?php

namespace App\Repository\Repos;

use App\Models\CancleInvoice;
use App\Models\CancleInvoiceItem;
use App\Repository\Interfaces\CancleInvoiceInterface;

class CancleInvoiceRepo implements CancleInvoiceInterface
{

    public function getLatestInvoiceWithCondition($whereConditon)
    {
        return CancleInvoice::with('merchant')->where($whereConditon)->latest('id');
    }

    public function getAnInstance($invoiceId)
    {
        return CancleInvoice::findOrFail($invoiceId);
    }

    public function getInvoiceDetailsById($invoiceId, $relationModel)
    {
        return CancleInvoice::with($relationModel)->findOrFail($invoiceId);
    }

    public function createInvoice(array $requestData){
        return CancleInvoice::create($requestData);
    }

    public function updateInvoice($requestData, $invoice)
    {
        return $invoice->update($requestData);
    }

    public function createInvoiceItems($requestData){
        return CancleInvoiceItem::create($requestData);
    }

    public function countInvoice($condition){
        return CancleInvoice::where($condition)->count();
    }
}
