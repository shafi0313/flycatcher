<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Models\CancleInvoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\ParcelInterface;
use App\Http\Requests\StoreCancleInvoiceRequest;
use App\Repository\Interfaces\MerchantInterface;
use App\Http\Requests\UpdateCancleInvoiceRequest;
use App\Repository\Interfaces\CancleInvoiceInterface;

class CancleInvoiceController extends Controller
{
    protected $cancleInvoiceRepo;
    protected $merchantRepo;
    protected $parcelRepo;

    public function __construct(CancleInvoiceInterface $cancleInvoice, ParcelInterface $parcel, MerchantInterface $merchant)
    {
        $this->cancleInvoiceRepo = $cancleInvoice;
        $this->merchantRepo = $merchant;
        $this->parcelRepo = $parcel;
    }

    public function index()
    {
        if (auth()->user()->hasRole(['Admin', 'Accountant','Chairman','Developer','Super Admin'])) {
            $invoices = $this->cancleInvoiceRepo->getLatestInvoiceWithCondition([]);
        } else {

            $invoices = $this->cancleInvoiceRepo->getLatestInvoiceWithCondition(['created_by' => \auth('admin')->user()->id]);
        }

        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('merchant_info', function ($invoice) {
                    if (isset($invoice->merchant)) {
                        return '<b>Name: </b>' . $invoice->merchant->name .
                            '<br><b>Mobile: </b>' . $invoice->merchant->mobile;
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
                    return view('admin.cancle-invoice.action-button', compact('invoice'));
                })
                ->rawColumns(['action', 'merchant_info', 'date_and_time'])
                ->tojson();
        }
        return view('admin.cancle-invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new CancleInvoice(),
            'merchants' => $this->merchantRepo->allMerchantList(),
            // 'parcels' => Parcel::where('status', 'cancelled')->get(),
        ];
        return view('admin.cancle-invoice.create_vue', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCancleInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        // if (!auth()->user()->hasAnyRole(['Station Officer'])) {
        //     abort(403, 'Unauthorized action.');
        // }
        $request->validate([
            'merchant_id' => 'required',
            'note' => 'nullable'
        ]);

        // dd( $request->all());

        // try {

        //  DB::beginTransaction();

        $cancle_invoice = new CancleInvoice();
        $cancle_invoice->invoice_number = 'CP-INV-' . \App\Classes\CancleInvoiceNumber::serial_number();
        $cancle_invoice->merchant_id = $request->merchant_id;
        $cancle_invoice->total_parcel_price = $request->total_parcel_price;
        $cancle_invoice->total_collection_amount = $request->total_collection_amount;
        $cancle_invoice->total_cod = $request->total_cod;
        $cancle_invoice->total_delivery_charge = $request->total_delivery_charge;
        $cancle_invoice->total_payable = $request->total_payable;
        $cancle_invoice->created_by = Auth::id();
        $cancle_invoice->save();

        $items = $request->get('items');

        foreach ($items as $row) {
            $parcel = Parcel::find($row['parcel_id']);
            $parcel->cancle_partial_invoice = 'yes';
            $parcel->update();
            $cancle_invoice->invoiceItems()->create($row);
        }

        // DB::commit();

        Toastr::success('Cancle Invoice Created Successful!.', '', ["progressBar" => true]);
        return redirect()->route('admin.cancle-invoice.index');
        //  } catch (\Exception $e) {
        //   DB::rollBack();
        //   Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());

        //   Toastr::info('Something went wrong!.', '', ["progressbar" => true]);
        //    return back();
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CancleInvoice  $cancleInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(CancleInvoice $cancleInvoice)
    {
        $data['invoice'] = $this->cancleInvoiceRepo->getInvoiceDetailsById($cancleInvoice->id, ['invoiceItems', 'invoiceItems.parcel']);
        return view('admin.cancle-invoice.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CancleInvoice  $cancleInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(CancleInvoice $cancleInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCancleInvoiceRequest  $request
     * @param  \App\Models\CancleInvoice  $cancleInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCancleInvoiceRequest $request, CancleInvoice $cancleInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CancleInvoice  $cancleInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancleInvoice $cancleInvoice)
    {
        //
    }
    public function pdf($invoiceId)
    {
        $invoice = $this->cancleInvoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'invoiceItems.parcel']);
        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView(
            'admin.cancle-invoice.pdf',
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
