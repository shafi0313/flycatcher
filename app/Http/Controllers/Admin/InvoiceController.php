<?php

namespace App\Http\Controllers\Admin;

use PDF;
use App\Models\Admin;
use App\Models\Parcel;
use App\Models\Invoice;
use App\Models\Merchant;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Exports\InvoicesExport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\InvoiceRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\InvoiceInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\CollectionInterface;

class InvoiceController extends Controller
{

    protected $invoiceRepo;
    protected $merchantRepo;
    protected $collectionRepo;

    public function __construct(InvoiceInterface $invoice, MerchantInterface $merchant, CollectionInterface $collection)
    {
        $this->invoiceRepo = $invoice;
        $this->merchantRepo = $merchant;
        $this->collectionRepo = $collection;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['invoice_type' => Admin::class, 'invoice_id' => \auth('admin')->user()->id, 'prepare_for_type' => Merchant::class]);
        $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['invoice_type' => Admin::class, 'prepare_for_type' => Merchant::class]);
        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('merchant_info', function ($invoice) {
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
                ->addColumn('invoice_total', function ($invoice) {
                    return $invoice->total_collection_amount - $invoice->total_delivery_charge;
                })
                ->addColumn('action', function ($invoice) {
                    return view('admin.invoice.action-button', compact('invoice'));
                })
                ->rawColumns(['action', 'merchant_info', 'date_and_time', 'invoice_total'])
                ->tojson();
        }
        return view('admin.invoice.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ajax
        // $dueList = Collection::with('merchant')->select('*', DB::raw('SUM(net_payable) as total_due'))
        //     ->where(['accounts_collected_status' => 'collected', 'merchant_paid' => 'unpaid'])
        //     ->groupBy('merchant_id')
        //     ->havingRaw('SUM(net_payable) > 0')
        //     ->latest('total_due')
        //     ->get();

        // $data = [
        //     'model' => new Parcel(),
        //     'merchants' =>  $dueList,
        // ];
        // return view('admin.invoice.create_ajax', $data);
        //vue
        $data = [
            'model' => new Parcel(),
            'merchants' => $this->merchantRepo->allMerchantList(),
        ];
        return view('admin.invoice.create_vue', $data);
    }

    public function merchantWiseUnpaidParcelSearch(Request $request)
    {

        if ($request->ajax()) {
            $merchant_unpaid_parcel = Collection::with('parcel')->where('merchant_id', $request->merchant_id)->where('accounts_collected_status', 'collected')->where('merchant_paid', 'unpaid')->get() ?? [];
            $merchant_info = Merchant::with('payment_method', 'bank_account')->where('id', $request->merchant_id)->first() ?? [];
            $data = [
                'unpaid_parcel' => $merchant_unpaid_parcel,
                'merchant_info' => $merchant_info,
                'invoicedBy' => Auth::guard('admin')->user()->name,
            ];
            return response()->view('admin.invoice.search-result', $data);
        }
    }
    public function store(InvoiceRequest $request)
    {
        try {

            DB::beginTransaction();
            $data = $request->except(['items', 'merchant_id']);
            $data['invoice_id'] = \auth('admin')->user()->id;
            $data['invoice_type'] = Admin::class;
            $data['prepare_for_id'] = $request->merchant_id;
            $data['payment_method'] = $request->payment_method;
            $data['prepare_for_type'] = Merchant::class;
            $data['invoice_number'] = 'INV_' . \App\Classes\InvoiceNumber::serial_number();
            $data['date'] = Carbon::now()->format('Y-m-d');
            $invoice = $this->invoiceRepo->createInvoice($data);

            $items = $request->get('items');
            foreach ($items as $row) {
                $parcelId = $row['parcel_id'];
                $this->collectionRepo->updateCollection(['parcel_id' => $parcelId], ['merchant_paid' => 'paid', 'merchant_paid_time' => Carbon::now()]);
                $invoiceItemData = [
                    'parcel_id' => $row['parcel_id'],
                    'delivery_charge' => $row['delivery_charge'],
                    'cod_charge' => $row['cod_charge'],
                    'collection_amount' => $row['collection_amount'],
                    'net_payable' => $row['net_payable'],
                    'invoice_id' => $invoice->id,
                ];
                $this->invoiceRepo->createInvoiceItems($invoiceItemData);
            }
            DB::commit();
            return response()->successRedirect('invoice Create Successful!', 'admin.invoice.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return response()->errorRedirect('Something went wrong!.', 'admin.invoice.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Invoice $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        $data['invoice'] = $this->invoiceRepo->getInvoiceDetailsById($invoice->id, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);
        return view('admin.invoice.show', $data);
    }

    public function pdf($invoiceId)
    {
        $invoice = $this->invoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'invoiceItems.parcel', 'prepare_for']);

        $data = ['invoice' => $invoice];
        $pdf = PDF::loadView(
            'admin.invoice.pdf',
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
    public function excel($invoiceId)
    {
        return Excel::download(new InvoicesExport($invoiceId), 'invoices.xlsx');
    }
}
