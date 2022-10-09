<?php

namespace App\Http\Controllers\Api\Rider;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Collection;
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

    public function index(CollectionService $collectionService,$rider_id){

        $whereCondition = [
            'rider_collected_by'=> $rider_id,
            'rider_collected_status'=>'collected',
        ];
        $collections =Collection::where($whereCondition)->get();
       
        return  $collections;
    }

    public function riderCollectionSendIncharge(Request $request){
        $whereCondition = [
            'rider_collected_by'=> auth('rider')->user()->id,
            'rider_collected_status'=>'collected',
        ];
        $requestData = [
            'rider_collected_status'=> 'transfer_request',
            'rider_collection_transfer_for'=>$request->admin_id,
            'rider_transfer_request_time'=>Carbon::now(),
        ];

        try{
            DB::beginTransaction();
            $this->collectionRepo->updateCollection($whereCondition, $requestData);
            DB::commit();
            return response()->successRedirect('Your request for collection transfer send successfully', '');
        }catch (\Exception $e){
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), '');
        }

    }
}
