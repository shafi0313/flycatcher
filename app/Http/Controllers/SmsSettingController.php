<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use App\Models\Parcel;
use App\Models\SmsSetting;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSmsSettingRequest;
use App\Http\Requests\UpdateSmsSettingRequest;
use App\Models\SmsConfigure;

class SmsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $smsSetting = SmsSetting::latest()->first();
        return view('admin.sms-settings.create', compact('smsSetting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSmsSettingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $smsSetting = SmsSetting::latest()->first();
        if (isset($smsSetting)) {
            $smsSetting->mobile = $request->mobile;
            $smsSetting->ofc_send = $request->ofc_send;
            $smsSetting->merchant_send = $request->merchant_send;
            $smsSetting->customer_send = $request->customer_send;
            $smsSetting->save();
        } else {
            $aaa = new SmsSetting();
            $aaa->mobile = $request->mobile;
            $aaa->ofc_send = $request->ofc_send;
            $aaa->merchant_send = $request->merchant_send;
            $aaa->customer_send = $request->customer_send;
            $aaa->save();
        }
        return response()->successRedirect('Info Updated !','');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SmsSetting  $smsSetting
     * @return \Illuminate\Http\Response
     */
    public function show(SmsSetting $smsSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SmsSetting  $smsSetting
     * @return \Illuminate\Http\Response
     */
    public function edit(SmsSetting $smsSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSmsSettingRequest  $request
     * @param  \App\Models\SmsSetting  $smsSetting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSmsSettingRequest $request, SmsSetting $smsSetting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SmsSetting  $smsSetting
     * @return \Illuminate\Http\Response
     */
    public function destroy(SmsSetting $smsSetting)
    {
        //
    }
    public static function sendSMS($phone, $message, $shopId)
    {

        $url = SmsSettingController::getSmsApi($phone, $message, $shopId);
        // dd($url);
        $ch_banpage = curl_init($url);
        curl_setopt($ch_banpage, CURLOPT_URL, $url);
        // curl_setopt($ch_banpage, CURLOPT_HEADER, 0);
        curl_setopt($ch_banpage, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch_banpage);
        curl_close($ch_banpage);
        $dataInfo = json_decode($curl_scraped_page);
    }
    public static function getSmsApi($phone, $message, $hub_id)
    {
        $smsSetting = SmsConfigure::where('hub_id', $hub_id)->where('status', 1)->first();

        $apiKey = $smsSetting->apiKey;
        $senderId = $smsSetting->senderId;
        $message = urlencode($message);
        $url = "http://sms.iglweb.com/api/v1/send?api_key=" . $apiKey . "&contacts=" . $phone . "&senderid=" . $senderId . "&msg=" . $message;
        //dd($url);
        return $url;
    }
    public static function phoneNumberPrefix($phone)
    {
        $number = null;
        if (substr($phone, 0, 2) != '88')
            $number .= '88' . $phone;
        else
            $number .= $phone;
        return $number;
    }


    public static function testSms($parcel_id)
    {
        $parcel = Parcel::with('merchant')->where('id', $parcel_id)->first();
        $smsSetting = SmsSetting::latest()->first();

        $otp = substr(str_shuffle("0123456789"), 0, 4);

        // $phone =  $parcel->merchant->mobile;
        $phone =  $smsSetting->mobile;

        $hub_id = 1;

        $message = "Your parcel($parcel->invoice_id) is cancelled.Your OTP is-" . $otp . ".Parcelsheba";

        $phone = SmsSettingController::phoneNumberPrefix($phone);

        SmsSettingController::sendSMS($phone, $message, $hub_id);
        $is_otp = Otp::where('parcel_id', $parcel_id)->first();
        if ($is_otp) {
            $is_otp->otp = $otp;
            $is_otp->save();
        } else {
            $otptable = new Otp();
            $otptable->parcel_id = $parcel_id;
            $otptable->otp = $otp;
            $otptable->save();
        }
        return response()->json(['success' => 'OTP Sent Successfully']);
    }
}
