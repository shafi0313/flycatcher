<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\InvoiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PHPUnit\Exception;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class InvoiceController extends Controller
{
    protected $invoiceRepo;
    protected $collectionRepo;

    public function __construct(InvoiceInterface $invoice, CollectionInterface $collection)
    {
        $this->invoiceRepo = $invoice;
        $this->collectionRepo = $collection;
    }

    public function invoiceList(){
        if(request()->status){
            $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['prepare_for_id'=>auth('merchant')->user()->id,'prepare_for_type'=>Merchant::class, 'status'=>\request()->status]);
        }else{
            $invoices = $this->invoiceRepo->getLatestInvoiceWithCondition(['prepare_for_id'=>auth('merchant')->user()->id,'prepare_for_type'=>Merchant::class]);
        }
        if (\request()->ajax()) {
            return DataTables::of($invoices)
                ->addIndexColumn()
                ->addColumn('action', function ($invoice) {
                    return view('merchant.invoice.action-button', compact('invoice'));
                })
                ->rawColumns(['action'])
                ->tojson();
        }
        $data = [
            'all'=>$this->invoiceRepo->countInvoice(['prepare_for_id'=>auth('merchant')->user()->id,'prepare_for_type'=>Merchant::class]),
            'pending'=>$this->invoiceRepo->countInvoice(['prepare_for_id'=>auth('merchant')->user()->id,'prepare_for_type'=>Merchant::class, 'status'=>'pending']),
            'accepted'=>$this->invoiceRepo->countInvoice(['prepare_for_id'=>auth('merchant')->user()->id,'prepare_for_type'=>Merchant::class, 'status'=>'accepted']),
        ];
        return view('merchant.invoice.list', $data);
    }

    public function show($invoiceId){
        $invoice = $this->invoiceRepo->getInvoiceDetailsById($invoiceId, ['invoiceItems', 'prepare_for']);
        if (\request()->ajax()) {
            $details = $invoice->InvoiceDetailsItem;
            return DataTables::of($details)
                ->addIndexColumn()
                ->addColumn('parcel_tracking_id', function ($detail) {
                    return '<a href="'.route('merchant.parcel.show', $detail->parcel->id).'" target="_blank">'.$detail->parcel->tracking_id.'</a>';
                })
                ->addColumn('parcel_price', function ($detail) {
                    return number_format($detail->parcel->collection_amount);
                })
                ->addColumn('original_collection', function ($detail) {
                    return number_format($detail->parcel->collection->amount);
                })

                ->addColumn('delivery_charge', function ($detail) {
                    return number_format($detail->parcel->collection->delivery_charge);
                })
                ->addColumn('cod_charge', function ($detail) {
                    return number_format($detail->parcel->collection->cod_charge);
                })

                ->addColumn('receivable', function ($detail) {
                    return number_format($detail->parcel->collection->net_payable);
                })
                ->rawColumns(['action', 'parcel_tracking_id', 'parcel_price', 'original_collection'])
                ->tojson();
        }
        $data['invoice'] = $invoice;
        return view('merchant.invoice.show', $data);
    }

    public function accept($invoiceId){
        $invoice = $this->invoiceRepo->getAnInstance($invoiceId);
        try {
            DB::beginTransaction();
            $this->invoiceRepo->updateInvoice(['status'=>'accepted'],$invoice);
            $this->collectionRepo->updateCollection(['merchant_id'=>auth('merchant')->user()->id, 'merchant_paid'=>'paid'], ['merchant_paid'=>'received']);
            DB::commit();
            return response()->successRedirect('You Received This Invoice', '');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
            return response()->errorRedirect('Something went wrong!.', '');
        }
    }
}
