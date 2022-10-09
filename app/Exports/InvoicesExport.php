<?php

namespace App\Exports;

use App\Models\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class InvoicesExport implements FromView
{
    protected $invoice_id;
    public function  __construct($invoice_id)
    {
        $this->invoice_id = $invoice_id;
    }
    public function view(): View
    {
        return view('admin.excel.exports.invoices', [
            'invoice' => Invoice::find( $this->invoice_id)
        ]);
    }
}