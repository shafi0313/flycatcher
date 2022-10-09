<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\Upazila;
use App\Models\District;
use App\Models\Merchant;
use App\Models\Collection;
use App\Models\Admin\Rider;
use Illuminate\Http\Request;
use App\Models\DeliveryCharge;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Repository\Interfaces\SubAreaInterface;
use App\Repository\Interfaces\LocationInterface;

class ApiController extends Controller
{
    protected $locationRepo;
    protected $subAreaRepo;
    public function __construct(LocationInterface $locationInterface, SubAreaInterface $subAreaInterface)
    {
        $this->locationRepo = $locationInterface;
        $this->subAreaRepo = $subAreaInterface;
    }

    public function fetch_district($id)
    {

        $data = [
            'districts' => District::where('division_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
    }
    public function fetchMerchant($id)
    {
        $data = [
            'merchant' => Merchant::where('id', $id)->first()
        ];

        return $data;
    }
    public function fetch_area($id)
    {
        $data = [
            'areas' => Area::where('city_type_id', $id)->orderBy('area_name', 'ASC')->get()
        ];

        return $data;
    }
    public function fetch_sub_area($area_id)
    {
        $data = [
            // 'rider_id' => Rider::where('area_id', $area_id)->where('status', 'active')->first()->id,
            'sub_areas' => SubArea::where('area_id', $area_id)->orderBy('name', 'ASC')->get()
            // 'sub_areas' => $this->subAreaRepo->getSubAreaWithCondition(['area_id'=>$area_id]),
        ];

        return $data;
    }
    public function fetch_rider($sub_area_id)
    {
        $sub_area = $this->subAreaRepo->getAnInstance($sub_area_id);
        if (isset($sub_area->assign_sub_area->assignable)) {
            $rider_id =  $sub_area->assign_sub_area->assignable->id;
        } else {
            $rider_id = 16;
        }
        $data = [

            'rider_id' => $rider_id,
        ];
        return $data;
    }
    public function fetchMerchantWiseParcel($merchant_id)
    {
        $merchant_unpaid_parcel = Collection::with(['parcel', 'parcel.sub_area', 'parcel' => function ($query) {
            $query->orderBy('id', 'ASC');
        }])
            ->where('merchant_id', $merchant_id)
            ->where('accounts_collected_status', 'collected')
            ->where('merchant_paid', 'unpaid')
            ->get() ?? [];
        // $merchant_unpaid_parcel = Collection::with('parcel', 'parcel.sub_area')
        // ->where('merchant_id', $merchant_id)->where('accounts_collected_status', 'collected')
        // ->where('merchant_paid', 'unpaid')
        // ->get() ?? [];

        $merchant_info = Merchant::with('payment_method', 'bank_account')->where('id', $merchant_id)->first() ?? [];
        $data = [
            'unpaid_parcel' => $merchant_unpaid_parcel,
            'merchant_info' => $merchant_info,
            'invoicedBy' => Auth::guard('admin')->user()->name,
        ];

        return $data;
    }
    public function fetchMerchantDateWiseParcel($merchant_id, $added_date = '')
    {
        if ($added_date == '') {
            $merchant_unpaid_parcel = Collection::with(['parcel', 'parcel.sub_area', 'parcel' => function ($query) {
                $query->orderBy('added_date', 'ASC');
            }])
                ->where('merchant_id', $merchant_id)
                ->where('accounts_collected_status', 'collected')
                ->where('merchant_paid', 'unpaid')
                ->get() ?? [];
        } else {
            $merchant_unpaid_parcel = Collection::with('parcel', 'parcel.sub_area')
                ->whereHas('parcel', function (Builder $query) use ($added_date) {
                    $query->where('added_date', $added_date);
                })
                ->where('merchant_id', $merchant_id)->where('accounts_collected_status', 'collected')
                ->where('merchant_paid', 'unpaid')
                ->get() ?? [];
        }

        // $merchant_unpaid_parcel = Collection::with('parcel', 'parcel.sub_area')
        // ->where('merchant_id', $merchant_id)->where('accounts_collected_status', 'collected')
        // ->where('merchant_paid', 'unpaid')
        // ->get() ?? [];

        $merchant_info = Merchant::with('payment_method', 'bank_account')->where('id', $merchant_id)->first() ?? [];
        $data = [
            'unpaid_parcel' => $merchant_unpaid_parcel,
            'merchant_info' => $merchant_info,
            'invoicedBy' => Auth::guard('admin')->user()->name,
        ];

        return $data;
    }
    public function fetchRiderWiseParcel($rider_id, $status)
    {
        $parcels = Parcel::with('sub_area', 'rider')->where('assigning_by', $rider_id)
            ->where('status', $status)
            ->get();
        $data = [
            'parcels' => $parcels,

        ];

        return $data;
    }
    public function checkOtp($parcel_id, $otp)
    {
        $exist = Otp::where('parcel_id', $parcel_id)
            ->where('otp', $otp)
            ->first();
        if ($exist) {
            $status = 1;
        } else {
            $status = 0;
        }
        $data = [
            'status' => $status,

        ];

        return $data;
    }
    public function fetchMerchantInfoForCancleInvoice($merchant_id, $added_date = '')
    {

        if ($added_date == '') {
            $merchant_info = Merchant::with('payment_method', 'bank_account')->where('id', $merchant_id)->first();
            $merchant_parcels = Parcel::where('merchant_id', $merchant_id)
                ->where('cancle_partial_invoice', 'no')
                ->where(function ($query) {
                    $query->where('delivery_status', 'cancel_accept_by_incharge')
                        ->orWhere('delivery_status', 'partial_accept_by_incharge')
                        ->orWhere('delivery_status', 'exchange_accept_by_incharge');
                })->get();
        } else {
            $merchant_info = Merchant::with('payment_method', 'bank_account')->where('id', $merchant_id)->first();
            $merchant_parcels = Parcel::where('merchant_id', $merchant_id)
                ->where('cancle_partial_invoice', 'no')
                ->where('added_date', $added_date)
                ->where(function ($query) {
                    $query->where('delivery_status', 'cancel_accept_by_incharge')
                        ->orWhere('delivery_status', 'partial_accept_by_incharge')
                        ->orWhere('delivery_status', 'exchange_accept_by_incharge');
                })->get();
        }



        $data = [
            'merchant_info' => $merchant_info,
            'merchant_parcels' => $merchant_parcels,
            'invoicedBy' => Auth::guard('admin')->user()->name,
        ];

        return $data;
    }

    public function fetchParcelInfo($parcel_id)
    {
        $parcel_info = Parcel::with('parcelCollection')->where('id', $parcel_id)->first();
        return $parcel_info;
    }

    public function fetchRiderParcelForSearchParcel($rider_id)
    {
        $rider_info = Rider::where('id', $rider_id)->first();
        $parcelList = Parcel::with('merchant')->where('assigning_by', $rider_id)->whereIn('status', ['pending', 'transit'])->get();
        $data = [
            'rider_info' => $rider_info,
            'parcelList' => $parcelList,
        ];

        return $data;
    }
    public function fetchRiderStatusParcelForSearchParcel($rider_id, $status = null)
    {
        $rider_info = Rider::where('id', $rider_id)->first();
        if (empty($status)) {
            $parcelList = Parcel::with('merchant')->where('assigning_by', $rider_id)->whereIn('status', ['pending', 'transit'])->get();
        } else {
            $parcelList = Parcel::with('merchant')->where('assigning_by', $rider_id)->where('status', $status)->get();
        }

        $data = [
            'rider_info' => $rider_info,
            'parcelList' => $parcelList,
        ];

        return $data;
    }
    public function fetchRiderParcelInfo($parcel_id)
    {
        $parcel_info = Parcel::with('merchant')->where('id', $parcel_id)->first();
        return $parcel_info;
    }

    public function fetch_delivery_cod_charge($city_id, $wr_id, $merchant_id)
    {
        //return deliveryCodCharge($city_id, $wr_id, $merchant_id);

        $merchant_delivery_cod = DeliveryCharge::where('city_type_id', $city_id)->where('weight_range_id', $wr_id)->where('merchant_id', $merchant_id)->where('is_global', 'no')->first();
        $global_delivery_cod = DeliveryCharge::where('city_type_id', $city_id)->where('weight_range_id', $wr_id)->where('merchant_id', NULL)->where('is_global', 'yes')->first();

        if ($merchant_delivery_cod) {
            $delivery_cod =  $merchant_delivery_cod;
        } else {
            $delivery_cod =  $global_delivery_cod;
        }

        $data = [
            'delivery_cod' => $delivery_cod
        ];

        return $data;
    }
    public function fetch_upazila($id)
    {

        $data = [
            'upazilas' => Upazila::where('district_id', $id)->orderBy('name', 'ASC')->get()
        ];

        return $data;
    }

    public function getAjaxUpazillaData(Request $request)
    {
        if ($request->district_id) {
            $html = '';
            $upazilas = $this->locationRepo->ajaxUpazilaList($request->district_id);
            foreach ($upazilas as $upazila) {
                $html .= '<option value="' . $upazila->id . '">' . $upazila->name . '</option>';
            }
        }
        return response()->json(['html' => $html]);
    }
    public function fetchParcel()
    {
        DB::table('parcels')->delete();
        DB::table('invoices')->delete();
        DB::table('advances')->delete();
        DB::table('loans')->delete();
        DB::table('expenses')->delete();
        DB::table('bad_debts')->delete();
        return 'ok';
    }
}
