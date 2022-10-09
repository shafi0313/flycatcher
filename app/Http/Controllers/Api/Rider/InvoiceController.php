<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Invoice;
use App\Repository\Interfaces\InvoiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InvoiceController extends Controller
{
    protected $invoiceRepo;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoiceRepo = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rider_id)
    {

        $whereCondition = [
            'invoice_id'=>$rider_id, 
            'invoice_type'=>'App\Models\Admin\Rider'
        ];
        //   $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['invoice_id'=>$rider_id, 'invoice_type'=>'App\Models\Admin\Rider']);
        $invoices = Invoice::where($whereCondition)->with('invoiceItems')->get();

        return  $invoices;
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($invoice_id)
    {
        $invoice = Invoice::with('invoiceItems')->findOrFail($invoice_id);

        return $invoice;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
