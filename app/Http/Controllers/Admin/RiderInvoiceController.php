<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Repository\Interfaces\InvoiceInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class RiderInvoiceController extends Controller
{
    protected $invoiceRepo;

    public function __construct(InvoiceInterface $invoice)
    {
        $this->invoiceRepo = $invoice;
    }
    public function invoiceList()
    {
        $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['prepare_for_id' => \auth('admin')->user()->id, 'invoice_type' => 'App\Models\Admin\Rider']);
        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('rider_info', function ($rider_invoice) {
                    if (isset($rider_invoice->invoice)) {
                        return '<b>Name: </b>' . $rider_invoice->invoice->name .
                            '<br><b>Mobile: </b>' . $rider_invoice->invoice->mobile;
                    } else {
                        return '<i class="text-danger">No merchant found</i>';
                    }
                })
                ->addColumn('date_and_time', function ($rider_invoice) {
                    return '<b>Date: </b>' . $rider_invoice->created_at->format('d:M Y') .
                        '<br><b>Time: </b>' . $rider_invoice->created_at->format('h:i A') .
                        '<br><b>Created: </b>' . $rider_invoice->created_at->diffForHumans();
                })
                ->addColumn('action', function ($rider_invoice) {
                    return view('admin.invoice.rider.action-button', compact('rider_invoice'));
                })
                ->rawColumns(['action', 'rider_info', 'date_and_time'])
                ->tojson();
        }
        return view('admin.invoice.rider.index');
    }

    public function show($id)
    {
        $data['invoice'] = $this->invoiceRepo->getInvoiceDetailsById($id, ['invoiceItems', 'invoiceItems.parcel', 'invoiceItems.parcel.merchant', 'invoiceItems.parcel.rider', 'invoiceItems.parcel.collection', 'prepare_for']);
        return view('admin.invoice.rider.show', $data);
    }
    public function pdf($invoiceId)
    {
        $invoice = $this->invoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);

        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView(
            'admin.invoice.rider.pdf',
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
}
