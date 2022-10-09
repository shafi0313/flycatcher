<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repository\Interfaces\InvoiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class InchargeInvoiceController extends Controller
{
    protected $invoiceRepo;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoiceRepo = $invoice;
    }
    public function invoiceList()
    {
        $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['invoice_id' => \auth('admin')->user()->id, 'invoice_type' => Admin::class]);
        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('accountant_info', function ($invoice) {
                    if (isset($invoice->prepare_for)) {
                        return '<b>Name: </b>' . $invoice->prepare_for->name .
                            '<br><b>Mobile: </b>' . $invoice->prepare_for->mobile;
                    } else {
                        return '<i class="text-danger">No merchant found</i>';
                    }
                })
                ->addColumn('date_and_time', function ($invoice) {
                    return '<b>Date: </b>' . $invoice->created_at->format('d:M Y') .
                        '<br><b>Time: </b>' . $invoice->created_at->format('h:i A') .
                        '<br><b>Created: </b>' . $invoice->created_at->diffForHumans();
                })
                ->addColumn('action', function ($invoice) {
                    return view('admin.invoice.incharge.action-button', compact('invoice'));
                })
                ->rawColumns(['action', 'accountant_info', 'date_and_time'])
                ->tojson();
        }
        return view('admin.invoice.incharge.index');
    }

    public function show($id)
    {
        $data['invoice'] = $this->invoiceRepo->getInvoiceDetailsById($id, ['invoiceItems', 'invoiceItems.parcel', 'invoiceItems.parcel.merchant', 'invoiceItems.parcel.rider', 'invoiceItems.parcel.collection', 'prepare_for']);
        return view('admin.invoice.incharge.show', $data);
    }
    public function pdf($invoiceId)
    {
        $invoice = $this->invoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);

        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView(
            'admin.invoice.incharge.pdf',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
                'title' => 'PDF Title',
                'author' => 'PDF Author',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 25,
                'margin_bottom' => 20,
                'margin_header' => 5,
                'margin_footer' => 10,
                'showImageErrors' => true
            ]
        );
        $name = $invoiceId;
        return $pdf->stream($name . '.pdf');
    }
    public function slip($invoiceId)
    {
        $invoice = $this->invoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);

        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView(
            'admin.invoice.incharge.slip',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
                'title' => 'PDF Title',
                'author' => 'PDF Author',
                'margin_left' => 10,
                'margin_right' => 10,
                'margin_top' => 25,
                'margin_bottom' => 20,
                'margin_header' => 5,
                'margin_footer' => 10,
                'showImageErrors' => true
            ]
        );
        $name = $invoiceId;
        return $pdf->stream($name . '.pdf');
    }
}
