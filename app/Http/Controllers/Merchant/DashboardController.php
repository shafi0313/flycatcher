<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Parcel;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\PickupRequestInterface;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Http\Controllers\Controller;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use App\Repository\Interfaces\DeliveryChargeInterface;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected $merchantRepo;
    protected $deliveryChargeRepo;
    protected $collectionRepo;
    protected $parcelRepo;
    protected $pickupRepo;
    public function __construct(ParcelInterface $parcel, PickupRequestInterface $pickupRequest, MerchantInterface $merchant, DeliveryChargeInterface $deliveryCharge, CollectionInterface $collection)
    {
        $this->merchantRepo = $merchant;
        $this->deliveryChargeRepo = $deliveryCharge;
        $this->collectionRepo = $collection;
        $this->parcelRepo = $parcel;
        $this->pickupRepo = $pickupRequest;
    }

    public function index(){
        $data = [
            'total_parcel' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id()]),
            'total_parcel_delivered' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id(), 'status'=>'delivered']),
            'total_partial_delivered' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id(), 'status'=>'partial']),
            'total_parcel_transit' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id(), 'status'=>'transit']),
            'total_parcel_cancel' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id(), 'status'=>'cancelled']),
            'total_parcel_hold' => $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id'=>Auth::guard('merchant')->id(), 'status'=>'hold']),

            'total_pickup_request' => $this->pickupRepo->pickupRequestCountInDifferentStatus(['merchant_id'=>\auth('merchant')->user()->id]),
            'total_pickup_request_picked' => $this->pickupRepo->pickupRequestCountInDifferentStatus(['merchant_id'=>\auth('merchant')->user()->id, 'status'=>'picked']),
            'total_pickup_request_cancel' => $this->pickupRepo->pickupRequestCountInDifferentStatus(['merchant_id'=>\auth('merchant')->user()->id, 'status'=>'cancelled']),

            'charges' => $this->deliveryChargeRepo->allDeliveryChargeList(),
            'merchant' => $this->merchantRepo->merchantDetailsInstance(auth('merchant')->user()->id),

            'cash' => $this->collectionRepo->totalAmount(['merchant_id'=>\auth('merchant')->user()->id, 'accounts_collected_status'=>'collected', 'merchant_paid'=>'unpaid'], 'net_payable'),
            'cash_received' => $this->collectionRepo->totalAmount(['merchant_id'=>\auth('merchant')->user()->id, 'accounts_collected_status'=>'collected', 'merchant_paid'=>'paid'], 'net_payable'),
        ];
        return view('merchant.dashboard', $data);
    }
}
