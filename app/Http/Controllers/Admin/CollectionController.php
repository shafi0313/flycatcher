<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Models\Merchant;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\InvoiceInterface;
use App\Repository\Interfaces\RiderInterface;
use App\services\CollectionService;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    protected $collectionRepo;
    protected $riderRepo;
    protected $adminRepo;
    protected $invoiceRepo;

    public function __construct(CollectionInterface $collection, RiderInterface $rider, AdminInterface $admin, InvoiceInterface $invoice)
    {
        $this->riderRepo = $rider;
        $this->collectionRepo = $collection;
        $this->adminRepo = $admin;
        $this->invoiceRepo = $invoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return auth('admin')->user()->id;
        //$riders = $this->collectionRepo->allLatestCollectionRiderBasis();

        $collections = Collection::with(['rider' => function ($q) {
            $q->select(['id', 'name', 'mobile', 'rider_code']);
        }])->select(['id', 'amount', 'parcel_id', 'rider_collected_by', 'rider_collection_transfer_for', 'rider_collected_status'])
            ->where(['rider_collected_status' => 'transfer_request', 'rider_collection_transfer_for' => auth('admin')->user()->id])
            ->groupBy('rider_collected_by')
            ->latest()->get();

        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('rider_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->rider->name .
                        '<br><b>Code: </b>' . $collection->rider->rider_code .
                        '<br><b>Mobile: </b>' . $collection->rider->mobile;
                })
                ->addColumn('collected_amount', function ($collection) {
                    return number_format($this->collectionRepo->totalAmount(['rider_collected_by' => $collection->rider->id, 'rider_collected_status' => 'transfer_request', 'rider_collection_transfer_for' => auth('admin')->user()->id], 'amount'));
                })
                ->addColumn('action', function ($collection) {
                    $data['riderId'] = $collection->rider->id;
                    return view('admin.collection.incharge.action-button', $data);
                })
                ->rawColumns(['rider_info', 'collected_amount', 'action'])
                ->tojson();
        }
        return view('admin.collection.incharge.index');
    }

    public function accountIndex()
    {
        if (\request()->ajax()) {
            $collections = $this->collectionRepo->allLatestCollectionInchargeBasis();
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('incharge_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->incharge->name .
                        '<br><b>Mobile: </b>' . $collection->incharge->mobile;
                })
                ->addColumn('collected_amount', function ($collection) {
                    return number_format(Collection::where(['incharge_collected_by' => $collection->incharge->id, 'incharge_collected_status' => 'transfer_request'])->sum('amount'));
                })
                ->addColumn('action', function ($collection) {
                    $data['inchargeId'] = $collection->incharge->id;
                    return view('admin.collection.account.action-button', $data);
                })
                ->rawColumns(['incharge_info', 'collected_amount', 'action'])
                ->tojson();
        }
        return view('admin.collection.account.index');
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function inchargeCollectionShow($riderId)
    {
        $data['rider'] = $this->riderRepo->getAnInstance($riderId);
        $data['collections'] = $this->collectionRepo->getAllCollectionInConditionBasis([
            'rider_collected_by' => $riderId,
            'rider_collected_status' => 'transfer_request',
            'rider_collection_transfer_for' => auth('admin')->user()->id
        ]);
        return view('admin.collection.incharge.show', $data);
    }


    public function accountCollectionShow($inchargeId)
    {
        $data['incharge'] = $this->adminRepo->getAnInstance($inchargeId);
        $data['collections'] = $this->collectionRepo->getAllCollectionInConditionBasis([
            'incharge_collected_by' => $inchargeId,
            'incharge_collected_status' => 'transfer_request'
        ]);
        return view('admin.collection.account.show', $data);
    }


    public function inchargeCollectionCollect($riderId)
    {
        $whereCondition = [
            'rider_collected_by' => $riderId,
            'rider_collected_status' => 'transfer_request',
            'rider_collection_transfer_for' => auth('admin')->user()->id,
        ];

        $requestData = [
            'rider_collected_status' => 'transferred',
            'incharge_collected_by' => auth('admin')->user()->id,
            'incharge_collected_time' => Carbon::now(),
            'incharge_collected_status' => 'collected'
        ];
        $invoiceData = [
            'invoice_id' => $riderId,
            'invoice_type' => Rider::class,
            'prepare_for_id' => auth('admin')->user()->id,
            'prepare_for_type' => Admin::class,
            'invoice_number' => 'INV_' . \App\Classes\InvoiceNumber::serial_number(),
            'total_collection_amount' => $this->collectionRepo->totalAmount(['rider_collected_by' => $riderId, 'rider_collected_status' => 'transfer_request'], 'amount'),
            'total_delivery_charge' => $this->collectionRepo->totalAmount(['rider_collected_by' => $riderId, 'rider_collected_status' => 'transfer_request'], 'delivery_charge'),
            'total_cod' => $this->collectionRepo->totalAmount(['rider_collected_by' => $riderId, 'rider_collected_status' => 'transfer_request'], 'cod_charge'),
            'date' => Carbon::now(),
            'status' => 'accepted'
        ];
        $items = $this->collectionRepo->getAllCollectionInConditionBasis(['rider_collected_by' => $riderId, 'rider_collected_status' => 'transfer_request']);
        try {
            DB::beginTransaction();
            $this->collectionRepo->updateCollection($whereCondition, $requestData);
            $invoice = $this->invoiceRepo->createInvoice($invoiceData);
            foreach ($items as $row) {
                $invoiceItemData['parcel_id'] = $row->parcel_id;
                $invoiceItemData['delivery_charge'] = $row->delivery_charge;
                $invoiceItemData['cod_charge'] = $row->cod_charge;
                $invoiceItemData['collection_amount'] = $row->amount;
                $invoiceItemData['net_payable'] = $row->net_payable;
                $invoiceItemData['invoice_id'] = $invoice->id;
                $this->invoiceRepo->createInvoiceItems($invoiceItemData);
            }
            DB::commit();
            return response()->successRedirect('You collect successfully', 'admin.incharge.collection.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect($e->getMessage(), 'admin.incharge.collection.index');
        }
    }

    public function accountCollectionCollect($inchargeId)
    {
        $whereCondition = [
            'incharge_collected_by' => $inchargeId,
            'incharge_collected_status' => 'transfer_request'
        ];

        $requestData = [
            'incharge_collected_status' => 'transferred',
            'accounts_collected_by' => auth('admin')->user()->id,
            'accounts_collected_time' => Carbon::now(),
            'accounts_collected_status' => 'collected'
        ];

        try {
            $this->collectionRepo->updateCollection($whereCondition, $requestData);
            return response()->successRedirect('You collect successfully', 'admin.account.collection.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'admin.incharge.collection.index');
        }
    }

    public function inchargeCollectionTransfer(Request $request)
    {
        $request->validate([
            'admin_id' => 'required',
        ], [
            'admin_id.required' => 'Please Select Accountant',
        ]);
        $whereData = [
            'incharge_collected_by' => auth('admin')->user()->id,
            'incharge_collected_status' => 'collected',
        ];
        $items = $this->collectionRepo->collectionDetailsWithCondition(['parcel'], $whereData);
        $requestData = [
            'incharge_collected_status' => 'transfer_request',
            'incharge_transfer_request_time' => Carbon::now(),
        ];

        $invoiceData = [
            'invoice_id' => auth('admin')->user()->id,
            'invoice_type' => Admin::class,
            'prepare_for_id' => $request->admin_id,
            'prepare_for_type' => Admin::class,
            'invoice_number' => 'INV_' . \App\Classes\InvoiceNumber::serial_number(),
            'total_collection_amount' => $this->collectionRepo->totalAmount($whereData, 'amount'),
            'total_delivery_charge' => $this->collectionRepo->totalAmount($whereData, 'delivery_charge'),
            'total_cod' => $this->collectionRepo->totalAmount($whereData, 'cod_charge'),
            'date' => Carbon::now(),
            'status' => 'accepted'
        ];

        try {
            DB::beginTransaction();
            $this->collectionRepo->updateCollection($whereData, $requestData);
            $invoice = $this->invoiceRepo->createInvoice($invoiceData);
            foreach ($items as $row) {
                $invoiceItemData['parcel_id'] = $row->parcel_id;
                $invoiceItemData['delivery_charge'] = $row->delivery_charge;
                $invoiceItemData['cod_charge'] = $row->cod_charge;
                $invoiceItemData['collection_amount'] = $row->amount;
                $invoiceItemData['net_payable'] = $row->net_payable;
                $invoiceItemData['invoice_id'] = $invoice->id;
                $this->invoiceRepo->createInvoiceItems($invoiceItemData);
            }
            DB::commit();
            return response()->successRedirect('Your request for collection transfer send successfully', '');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), '');
        }
    }

    public function inchargeCollectionHistory(CollectionService $collectionService)
    {
        $collections = $this->collectionRepo->allLatestCollection(['incharge_collected_by' => auth('admin')->user()->id]);
        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('date_and_time', function ($collection) {
                    return '<b>Date: </b>' . $collection->created_at->format('d:M Y') .
                        '<br><b>Time: </b>' . $collection->created_at->format('H:i:s A');
                })
                ->addColumn('merchant_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->parcel->merchant->name .
                        '<br><b>Mobile: </b>' . $collection->parcel->merchant->mobile;
                })
                ->addColumn('accountant_info', function ($collection) {
                    if (isset($collection->accountant)) {
                        return '<b>Name: </b>' . $collection->accountant->name .
                            '<br><b>Email: </b>' . $collection->accountant->email .
                            '<br><b>Mobile: </b>' . $collection->accountant->mobile;
                    } else {
                        return '';
                    }
                })
                ->addColumn('rider_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->rider->name . '(' . $collection->rider->rider_code .
                        ')<br><b>Mobile: </b>' . $collection->rider->mobile;
                })
                ->addColumn('incharge_collected_status', function ($collection) use ($collectionService) {
                    return $collectionService->riderCollectedStatus($collection->incharge_collected_status);
                })
                ->rawColumns(['incharge_collected_status', 'merchant_info', 'date_and_time', 'rider_info', 'accountant_info'])
                ->tojson();
        }
        return view('admin.collection.incharge.history');
    }

    public function accountCollectionHistory(CollectionService $collectionService)
    {
        $collections = $this->collectionRepo->allLatestCollection(['accounts_collected_by' => auth('admin')->user()->id]);
        if (\request()->ajax()) {
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('merchant_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->parcel->merchant->name .
                        '<br><b>Mobile: </b>' . $collection->parcel->merchant->mobile;
                })
                ->addColumn('date_and_time', function ($collection) {
                    return '<b>Date: </b>' . $collection->created_at->format('d:M Y') .
                        '<br><b>Time: </b>' . $collection->created_at->format('H:i:s A');
                })
                ->addColumn('rider_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->rider->name . '(' . $collection->rider->rider_code .
                        ')<br><b>Mobile: </b>' . $collection->rider->mobile;
                })
                ->addColumn('incharge_info', function ($collection) {
                    return '<b>Name: </b>' . $collection->incharge->name .
                        '<br><b>Email: </b>' . $collection->incharge->email .
                        '<br><b>Mobile: </b>' . $collection->incharge->mobile;
                })
                ->rawColumns(['merchant_info', 'incharge_info', 'date_and_time', 'rider_info'])
                ->tojson();
        }
        return view('admin.collection.account.history');
    }

    public function inchargeCollectionList()
    {
        $inchargeId = auth('admin')->user()->id;
        //   dd($inchargeId);

        $data['incharge'] = Admin::find($inchargeId);
        $data['collections'] = Collection::where('incharge_collected_by', $inchargeId)
            ->where('incharge_collected_status', 'collected')
            ->groupBy('rider_collected_by')
            ->get();

        return view('admin.collection.account.list', $data);
    }
}
