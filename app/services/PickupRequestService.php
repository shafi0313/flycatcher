<?php

namespace App\services;

use App\Models\Parcel;
use App\Repository\Interfaces\PickupRequestInterface;
use App\Repository\Interfaces\RiderInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupRequestService
{
    public function dataTableMerchantRequest($pickRequestData): string
    {
        if(isset($pickRequestData->merchant)){
            return ' <br><b>Name:</b> '.$pickRequestData->merchant->name.
                ' <br><b>Mobile:</b> ' .$pickRequestData->merchant->mobile.
                ' <br><b>Company name:</b> ' .$pickRequestData->merchant->company_name.
                ' <br><b>Address:</b> '.$pickRequestData->merchant->address??'N/A';
        }else{
            return '<i class="text-danger">No merchant found</i>';
        }
    }

    public function dataTableDateTime($pickRequestData): string
    {
        return '<b>Date: </b>'.$pickRequestData->created_at->format('d-M-Y').
        '<br><b>Time: </b>'.$pickRequestData->created_at->format('H:i:s A').
        '<br><b>Created: </b>' . $pickRequestData->created_at->diffForHumans();
    }
    public function assignRiderInfo($pickupRequest): string
    {
        if(isset($pickupRequest->rider)){
            return ' <br><b>Rider name:</b> ' .$pickupRequest->rider->name.
                ' <br><b>Rider mobile:</b> ' .$pickupRequest->rider->mobile.
                '<br><b>Assign time:</b> ' . $pickupRequest->assigning_time.
                '<br><b>Accepted time:</b> ' . $pickupRequest->accepted_time.
                '<br><b>Picked time:</b> ' .$pickupRequest->picked_time;
        }else{
            return '<i class="text-danger">No merchant found</i>';
        }
    }
}
