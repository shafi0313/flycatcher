<?php


namespace App\Classes;

use App\Models\Parcel;

class TrackingNumber
{
    public static function serial_number()
    {
        do {
            $code = date('m').mt_rand(100000, 999999);
        } while (Parcel::where("tracking_id", $code)->first());

        return $code;
    }
}
