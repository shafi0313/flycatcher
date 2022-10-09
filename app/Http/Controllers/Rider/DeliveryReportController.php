<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class DeliveryReportController extends Controller
{
    public function show(){
        return view('rider.report.delivery.show');
    }

    public function searchResult(Request $request){
        if($request->ajax()){
            $days =  cal_days_in_month(CAL_GREGORIAN,$request->month,$request->year);

            $deliveryData = [];
            for($i= 1 ; $i<= $days ; $i++){
                array_push($deliveryData, [
                    'date'=> $i.'-'.date('M', mktime(0, 0, 0, $request->month)),
                    'fullDelivery'=>Collection::with('parcel')->whereHas('parcel', function ($query){
                        $query->where(['status'=>'delivered', 'assigning_by'=>auth('rider')->user()->id]);
                    })->where(['rider_collected_by'=>auth('rider')->user()->id, 'rider_collected_status'=>'transferred'])->whereDate('incharge_collected_time', '=', $request->year.'-'.$request->month.'-'.$i)->count(),
                    'partialDelivery'=>Collection::with('parcel')->whereHas('parcel', function ($query){
                        $query->where(['status'=>'partial', 'assigning_by'=>auth('rider')->user()->id]);
                    })->where(['rider_collected_by'=>auth('rider')->user()->id, 'rider_collected_status'=>'transferred'])->whereDate('incharge_collected_time', '=', $request->year.'-'.$request->month.'-'.$i)->count(),
                    'exchangeDelivery'=>Collection::with('parcel')->whereHas('parcel', function ($query){
                        $query->where(['status'=>'exchange', 'assigning_by'=>auth('rider')->user()->id]);
                    })->where(['rider_collected_by'=>auth('rider')->user()->id, 'rider_collected_status'=>'transferred'])->whereDate('incharge_collected_time', '=', $request->year.'-'.$request->month.'-'.$i)->count(),
                ]);
            }

            $data['deliveryData'] = $deliveryData;
            return response()->view('rider.report.delivery.search-result', $data);
        }
    }
}
