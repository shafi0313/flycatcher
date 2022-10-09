<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Collection;
use App\Models\SubArea;
use App\Repository\Interfaces\CollectionInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CollectionController extends Controller
{
    protected $collectionRepo;

    public function __construct(CollectionInterface $collection)
    {
        $this->collectionRepo = $collection;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $collections = $this->collectionRepo->allLatestCollection(['merchant_id' => auth('merchant')->user()->id, 'merchant_paid' => 'received']);
            return DataTables::of($collections)
                ->addIndexColumn()
                ->addColumn('parcel_info', function ($collection) {
                    return '<b>Tracking ID: </b>' . $collection->parcel->tracking_id .
                        '<br><b>Invoice No: </b>' . $collection->parcel->invoice_id .
                        '<br><b>Status: </b>' . ucfirst($collection->parcel->status);
                })
                ->addColumn('parcel_price', function ($collection) {
                    return '<b>Original Price: </b>' . $collection->parcel->collection_amount .
                        '<br><b>Delivery Charge: </b>' . $collection->parcel->delivery_charge .
                        '<br><b>COD: </b>' . $collection->parcel->cod .
                        '<br><b>Payable: </b>' . $collection->parcel->payable;
                })
                ->addColumn('collected_amount', function ($collection) {
                    return number_format($collection->amount);
                })
                ->rawColumns(['status', 'parcel_info', 'parcel_price', 'action', 'collected_amount'])
                ->tojson();
        }
        $data['balance'] = $this->collectionRepo->totalAmount(['merchant_id' => auth('merchant')->user()->id, 'merchant_paid' => 'received'], 'net_payable');
        return view('merchant.collection.index', $data);
    }

    public function coverageArea()
    {
        //$areas = Area::with('sub_areas')->get();
        $subAreas = SubArea::with('area')->latest();
        if (\request()->ajax()) {
            return DataTables::of($subAreas)
                ->addIndexColumn()
                ->tojson();
        }
        return view('merchant.coverage_area.index');
    }
}
