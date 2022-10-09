<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\Merchant;
use App\Models\WeightRange;
use Illuminate\Http\Request;
use App\Imports\ParcelsImport;
use App\Imports\ParcelsImportForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ParcelsImportFormMerchant;
use App\Repository\Interfaces\SubAreaInterface;

class ExcelController extends Controller
{


    protected $subAreaRepo;
    public function __construct(SubAreaInterface $subAreaInterface)
    {
        $this->subAreaRepo = $subAreaInterface;
    }

    public function parcelImport()
    {
        return view('merchant.excel.import');
    }
    public function importFormData()
    {
        $excelDatas = Excel::toCollection(new ParcelsImportFormMerchant, request()->file('file'));
        // dd($excelDatas);
        $datas = $excelDatas[0];
        return view('merchant.excel.show-excel', compact('datas'));
        //  return response()->json($excelDatas[0]);
    }
    public function parcelExcelStore(Request $request)
    {
        //  dd($request->all());

        // try {
        //     DB::beginTransaction();
        $parcels = $request->get('parcels');
        $total = count($parcels);
        foreach ($parcels as $parcel) {
            $subarea = $this->subAreaRepo->getAnInstance($parcel['sub_area_id']);
            $codDelivery = deliveryCodCharge($parcel['city_type_id'], $parcel['weight_range_id'], Auth::guard('merchant')->user()->id);
            $cod = $codDelivery['cod'] ?? 0;
            $delivery_charge = $codDelivery['delivery_charge'] ?? 0;

            $ap = new Parcel();
            $ap->invoice_id          = getPrefix(Auth::guard('merchant')->user()->id) . '-' .$parcel['invoice_id'];
            $ap->customer_name       = $parcel['customer_name'];
            $ap->customer_mobile     = $parcel['customer_mobile'];
            $ap->customer_address    = $parcel['customer_address'];
            $ap->area_id             = $parcel['area_id'];
            $ap->sub_area_id         = $parcel['sub_area_id'];
            $ap->city_type_id        = $parcel['city_type_id'];
            $ap->added_by_merchant   = Auth::guard('merchant')->user()->id;
            $ap->guard_name          = 'merchant';
            $ap->assigning_by        = $subarea->assign_sub_area->assignable_id ?? 16;
            $ap->assigned_by         = Auth::guard('merchant')->user()->id;
            $ap->weight_range_id     = $parcel['weight_range_id'];
            $ap->parcel_type_id      = $parcel['parcel_type_id'];
            $ap->tracking_id         = \App\Classes\TrackingNumber::serial_number();
            $ap->collection_amount   = $parcel['collection_amount'];
            $ap->delivery_charge     = $delivery_charge;
            $ap->cod                 = $parcel['collection_amount'] * $cod / 100;
            $ap->cod_percentage      = $cod;
            $ap->payable             = $parcel['collection_amount']  - $delivery_charge - ($parcel['collection_amount'] * $cod / 100);
            $ap->merchant_id         = Auth::guard('merchant')->user()->id;
            $ap->note                = $parcel['note'];
            $ap->status              = 'wait_for_pickup';
            $ap->added_date          = date('Y-m-d');
            $ap->hub_id          = \auth('merchant')->user()->hub_id;
            $ap->save();
        }
        return response()->successRedirect($total . " Parcel Successful Saved !", 'merchant.parcel.index');
        //  DB::commit();
        // all good
        // } catch (\Exception $e) {
        //     DB::rollBack();
        //     Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
        //     return response()->errorRedirect('Something went wrong!.', 'merchant.batchUpload');
        // }
    }
}
