<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use App\Models\Parcel;
use Illuminate\Http\Request;

class ParcelReportController extends Controller
{
    public function dateWiseParcel(){
        return view('merchant.report.date-wise.show');
    }

    public function dateWiseParcelSearch(Request $request){
        if($request->ajax()){
            $dateRange = explode('to', \request()->date_range);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";
            $parcels = Parcel::where(['merchant_id'=>auth('merchant')->user()->id])->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
            $collections = Collection::where(['merchant_id'=>auth('merchant')->user()->id])->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
            $receivable = Collection::where(['merchant_id'=>auth('merchant')->user()->id, 'merchant_paid'=>'unpaid'])->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();
            $received = Collection::where(['merchant_id'=>auth('merchant')->user()->id])->whereIn('merchant_paid', ['paid', 'received'])->whereBetween('created_at', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->get();

            $data['numberOfParcel'] =count($parcels);
            $data['totalParcelPrice'] = number_format($parcels->sum('collection_amount'));
            $data['totalDeliveryCharge'] = number_format($parcels->sum('delivery_charge'));
            $data['totalCodCharge'] = number_format($parcels->sum('cod'));
            $data['totalReceivable'] = number_format($parcels->sum('payable'));

            $data['numberOfCollection'] = count($collections);
            $data['totalCollectedAmount'] = number_format($collections->sum('amount'));
            $data['totalCollectedDeliveryCharge'] = number_format($collections->sum('delivery_charge'));
            $data['totalCollectedCodCharge'] = number_format($collections->sum('cod_charge'));
            $data['totalReceivedAmount'] = number_format($collections->sum('net_payable'));

            $data['numberOfReceivableParcel'] = count($receivable);
            $data['totalReceivableAmount'] = number_format($receivable->sum('amount'));
            $data['totalReceivableDeliveryCharge'] = number_format($receivable->sum('delivery_charge'));
            $data['totalReceivableCodCharge'] = number_format($receivable->sum('cod_charge'));
            $data['totalReceivableAmount'] = number_format($receivable->sum('net_payable'));

            $data['numberOfReceivedParcel'] = count($received);
            $data['totalReceivedAmount'] = number_format($received->sum('amount'));
            $data['totalReceivedDeliveryCharge'] = number_format($received->sum('delivery_charge'));
            $data['totalReceivedCodCharge'] = number_format($received->sum('cod_charge'));
            $data['totalReceivedAmount'] = number_format($received->sum('net_payable'));

            return response()->view('merchant.report.date-wise.search-result', $data);

        }
    }
}
