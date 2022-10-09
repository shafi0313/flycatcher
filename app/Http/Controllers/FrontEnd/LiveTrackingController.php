<?php

namespace App\Http\Controllers\FrontEnd;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LiveTrackingController extends Controller
{
    public function search(Request $request)
    {
        $request->except('_token');
        $parcel = Parcel::whereTracking_id($request->tracking_id)->first();
        if(!empty($parcel)){

            // return$parcel = Parcel::with(['sub_area' => fn ($q) => $q->select(['id','name'])])->whereTracking_id($request->tracking_id)->first(['id','tracking_id','invoice_id','payment_status','status','delivery_status','added_date','customer_mobile','sub_area->name']);
            $parcel = Parcel::with(
                ['area' => fn ($q) => $q->select(['id','area_name']),
                'sub_area' => fn ($q) => $q->select(['id','name']),
                'parcelType' => fn ($q) => $q->select(['id','name']) ])->whereTracking_id($request->tracking_id)->first();
            return view('front.live_tracking', compact('parcel'));
        }{
            session()->flash('message','No data found for tracking');
            return back();
        }
    }
}
