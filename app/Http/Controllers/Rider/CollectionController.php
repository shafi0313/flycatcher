<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\InvoiceInterface;
use App\services\CollectionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    protected $collectionRepo;
    protected $invoiceRepo;

    public function __construct(CollectionInterface $collection, InvoiceInterface $invoice)
    {
        $this->collectionRepo = $collection;
        $this->invoiceRepo = $invoice;
    }

    public function index(CollectionService $collectionService)
    {
        if (\request()->ajax()) {
            $collections = $this->collectionRepo->allLatestCollection(['rider_collected_by' => auth('rider')->user()->id]);
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('incharge_info', function ($collection) {
                    if (isset($collection->incharge)) {
                        return '<b>Name: </b>' . $collection->incharge->name .
                            '<br><b>Email: </b>' . $collection->incharge->email .
                            '<br><b>Mobile: </b>' . $collection->incharge->mobile;
                    } else {
                        return '';
                    }
                })
                ->addColumn('date_and_time', function ($collection) {
                    return '<b>Date: </b>' . $collection->created_at->format('d:M Y') .
                        '<br><b>Time: </b>' . $collection->created_at->format('H:i:s A');
                })
                ->addColumn('rider_collected_status', function ($collection) use ($collectionService) {
                    return $collectionService->riderCollectedStatus($collection->rider_collected_status);
                })
                ->rawColumns(['rider_collected_status', 'date_and_time', 'incharge_info'])
                ->tojson();
        }
        return view('rider.collection.index');
    }

    public function riderCollectionSendIncharge(Request $request)
    {

        $request->validate([
            'admin_id' => 'required',
        ], [
            'admin_id.required' => 'Please Select Incharge',
        ]);
        $whereCondition = [
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_status' => 'collected',
        ];
        $requestData = [
            'rider_collected_status' => 'transfer_request',
            'rider_collection_transfer_for' => $request->admin_id,
            'rider_transfer_request_time' => Carbon::now(),
        ];

        try {
            DB::beginTransaction();
            $this->collectionRepo->updateCollection($whereCondition, $requestData);
            DB::commit();
            return response()->successRedirect('Your request for collection transfer send successfully', '');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), '');
        }
    }
}
