<?php

namespace App\Repository\Repos;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Repository\Interfaces\InvoiceInterface;

class InvoiceRepo implements InvoiceInterface
{

    public function getLatestInvoiceWithCondition($whereConditon)
    {
        return Invoice::with('prepare_for','invoice')->where($whereConditon)->latest('id');
    }

    public function getAnInstance($invoiceId)
    {
        return Invoice::findOrFail($invoiceId);
    }

    public function getInvoiceDetailsById($invoiceId, $relationModel)
    {
        return Invoice::with($relationModel)->findOrFail($invoiceId);
    }

    public function createInvoice(array $requestData){
        return Invoice::create($requestData);
    }

    public function updateInvoice($requestData, $invoice)
    {
        return $invoice->update($requestData);
    }

    public function createInvoiceItems($requestData){
        return InvoiceItem::create($requestData);
    }

    public function countInvoice($condition){
        return Invoice::where($condition)->count();
    }
}
