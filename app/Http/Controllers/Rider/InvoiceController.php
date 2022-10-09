<?php

namespace App\Http\Controllers\Rider;

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
    public function index()
    {
        $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['invoice_id'=>\auth('rider')->user()->id, 'invoice_type'=>'App\Models\Admin\Rider']);
        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('incharge_info', function ($invoice) {
                    if (isset($invoice->prepare_for)) {
                        return '<b>Name: </b>' . $invoice->prepare_for->name .
                            '<br><b>Mobile: </b>' . $invoice->prepare_for->mobile;
                    } else {
                        return '<i class="text-danger">No merchant found</i>';
                    }
                })
                ->addColumn('date_time', function ($invoice) {
                    return '<b>Date: </b>' . date('d:M Y', strtotime($invoice->date)).
                        '<br><b>Time: </b>' . date('h:i A',strtotime($invoice->date));

                })
                ->addColumn('action', function ($invoice) {
                    return view('rider.invoice.action-button', compact('invoice'));
                })
                ->rawColumns(['action', 'incharge_info', 'date_time'])
                ->tojson();
        }
        return view('rider.invoice.index');

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $data['invoice'] = $this->invoiceRepo->getInvoiceDetailsById($invoice->id, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);
        return view('rider.invoice.show', $data);
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
