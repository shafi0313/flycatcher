<?php

namespace App\Repository\Interfaces;

interface CancleInvoiceInterface
{
    public function getLatestInvoiceWithCondition($whereCondition);

    public function getAnInstance($invoiceId);

    public function getInvoiceDetailsById($invoiceId, $relationModel);

    public function createInvoice(array $requestData);

    public function updateInvoice(array $requestData, $invoice);

    public function createInvoiceItems(array $requestData);

    public function countInvoice($condition);
}
