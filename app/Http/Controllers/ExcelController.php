<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\Merchant;
use Milon\Barcode\DNS1D;
use Milon\Barcode\DNS2D;
use App\Models\WeightRange;
use Illuminate\Http\Request;
use App\Imports\ParcelsImport;
use App\Imports\ParcelsImportForm;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Repository\Interfaces\SubAreaInterface;
use PDF;
class ExcelController extends Controller
{


    protected $subAreaRepo;
    public function __construct(SubAreaInterface $subAreaInterface)
    {
        $this->subAreaRepo = $subAreaInterface;
    }
    public function barcode($id)
    {
        $parcel=Parcel::find($id);
        $data = ['parcel' => $parcel];
        return view('admin.barcode.index', $data);
        // $pdf = PDF::loadView(
        //     'admin.barcode.index',
        //     $data,
        //     [],
        //     [
        //         'format' => 'A4-P',
        //         'orientation' => 'P',
        //         'title' => 'PDF Title',
        //         'author' => 'PDF Author',
        //         'margin_left' => 10,
        //         'margin_right' => 10,
        //         'margin_top' => 25,
        //         'margin_bottom' => 20,
        //         'margin_header' => 5,
        //         'margin_footer' => 10,
        //         'showImageErrors' => true
        //     ]
        // );
        // $name = $id;
        // return $pdf->stream($name . '.pdf');
    }
    public function parcelImportAdmin()
    {
        $data = [
            'merchants' => Merchant::all(),
        ];
        return view('admin.excel.import', $data);
    }
    public function parcelImport()
    {
        return view('merchant.excel.import');
    }
    public function importAdmin()
    {
        $merchant_id = request()->input('merchant_id');
        Excel::import(new ParcelsImport($merchant_id), request()->file('file'));
        return response()->successRedirect('Parcel Import Successful!', '');
    }

    public function parcelImportFormData()
    {
        $data = [
            'merchants' => Merchant::all(),
        ];
        return view('admin.excel.import-form', $data);
    }
    public function importFormData()
    {
        $merchant_id = request()->input('merchant_id');
        $excelDatas = Excel::toCollection(new ParcelsImportForm, request()->file('file'));
        // dd($excelDatas);
        $datas = $excelDatas[0];
        return view('admin.excel.show-excel', compact('datas', 'merchant_id'));
        //  return response()->json($excelDatas[0]);
    }
    public function parcelExcelStore(Request $request)
    {

        $parcels = $request->get('parcels');
        $total= count($parcels);
        foreach ($parcels as $parcel) {
            // $subarea = SubArea::where('id', $parcel['sub_area_id'])->first();
            $subarea=$this->subAreaRepo->getAnInstance($parcel['sub_area_id']);
            // $subarea = SubArea::where('area_id', $area->id)->first();
            // $WeightRange = WeightRange::where('min_weight', '<=', $row['weight'])->where('max_weight', '>=', $row['weight'])->first();
            $codDelivery = deliveryCodCharge($parcel['city_type_id'], $parcel['weight_range_id'], $request->merchant_id);
            $cod = $codDelivery['cod']??0;
            $delivery_charge = $codDelivery['delivery_charge']??0;

            $ap = new Parcel();
            $ap->invoice_id          = getPrefix($request->merchant_id) . '-' .$parcel['invoice_id'];
            $ap->customer_name       = $parcel['customer_name'];
            $ap->customer_mobile     = $parcel['customer_mobile'];
            $ap->customer_address    = $parcel['customer_address'];
            $ap->area_id             = $parcel['area_id'];
            $ap->sub_area_id         = $parcel['sub_area_id'];
            $ap->city_type_id        = $parcel['city_type_id'];
            $ap->assigning_by        = $subarea->assign_sub_area->assignable_id ?? 16;
            $ap->assigned_by         = Auth::guard('admin')->user()->id;
            $ap->weight_range_id     = $parcel['weight_range_id'];
            $ap->parcel_type_id      = $parcel['parcel_type_id'];
            $ap->tracking_id         = \App\Classes\TrackingNumber::serial_number();
            $ap->collection_amount   = $parcel['collection_amount'];
            $ap->added_by_admin      = Auth::guard('admin')->user()->id;
            $ap->guard_name          = 'admin';
            $ap->delivery_charge     = $delivery_charge;
            $ap->cod                 = $parcel['collection_amount'] * $cod / 100;
            $ap->cod_percentage      = $cod;
            $ap->payable             = $parcel['collection_amount']  - $delivery_charge - ($parcel['collection_amount'] * $cod / 100);
            $ap->merchant_id         = $request->merchant_id;
            $ap->note                = $parcel['note'];
            $ap->added_date          = $request->added_date ? $request->added_date : date('Y-m-d');
            $ap->hub_id              = \auth('admin')->user()->hub_id ?? 1;
            $ap->save();
        }
        return response()->successRedirect($total." Parcel Successful Saved !", 'admin.parcel.index');
    }
}
