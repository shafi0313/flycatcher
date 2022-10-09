<?php

namespace App\services;

use Carbon\Carbon;
use App\Models\Parcel;
use App\Models\AssignArea;
use App\Models\Collection;
use App\Models\ParcelNote;
use App\Models\Admin\Rider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\RiderInterface;
use App\Http\Controllers\SmsSettingController;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\ReasonInterface;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\AssignAreaInterface;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\ParcelNoteInterface;
use App\Repository\Interfaces\ParcelTimeInterface;
use App\Repository\Interfaces\ParcelTypeInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use App\Repository\Interfaces\RiderCollectionInterface;
use App\Repository\Interfaces\MerchantMobileBankingInterface;
use App\Repository\Interfaces\MobileBankingCollectionInterface;

class ParcelService
{
    protected $collectionRepo;
    public $parcelRepo;
    public $riderRepo;
    public $weightRangeRepo;
    public $parcelTypeRepo;
    public $merchantRepo;
    public $cityTypeRepo;
    public $reasonRepo;
    public $assignAreaRepo;
    public $mobileBankingRepo;
    protected $mobileBankingCollectionRepo;
    public $parcelTimeRepo;
    public $parcelNote;

    public function __construct(AssignAreaInterface $assignArea, ReasonInterface $reason, ParcelInterface $parcel, CollectionInterface $collection, RiderInterface $rider, WeightRangeInterface $weightRange, ParcelTypeInterface $parcelType, MerchantInterface $merchant, CityTypeInterface $cityType, MerchantMobileBankingInterface $merchantMobileBanking, MobileBankingCollectionInterface $mobileBankingCollection, ParcelTimeInterface $parcelTime, ParcelNoteInterface $parcelNote)
    {
        $this->collectionRepo = $collection;
        $this->parcelRepo = $parcel;
        $this->riderRepo = $rider;
        $this->weightRangeRepo = $weightRange;
        $this->parcelTypeRepo = $parcelType;
        $this->merchantRepo = $merchant;
        $this->cityTypeRepo = $cityType;
        $this->reasonRepo = $reason;
        $this->assignAreaRepo = $assignArea;
        $this->mobileBankingRepo = $merchantMobileBanking;
        $this->mobileBankingCollectionRepo = $mobileBankingCollection;
        $this->parcelTimeRepo = $parcelTime;
        $this->parcelNote = $parcelNote;
    }

    public function parcelShowStatus($status)
    {
        switch ($status) {
            case 'wait_for_pickup':
                return '<div class="badge badge-warning">' . ucwords(str_replace('_', ' ', $status)) . '</div>';
            case 'received_at_office':
                return '<div class="badge badge-glow badge-success">' . ucwords(str_replace('_', ' ', $status)) . '</div>';
            case 'transfer':
            case 'pending':
                return '<div class="badge badge-warning">' . ucfirst($status) . '</div>';
            case 'transit':
                return '<div class="badge badge-glow badge-info">Transit</div>';
            case 'partial':
                return '<div class="badge badge-pill badge-glow badge-primary">Partial</div>';
            case 'delivered':
                return '<div class="badge badge-success">' . ucfirst($status) . '</div>';
            case 'exchange':
                return '<div class="badge badge-success">' . ucfirst($status) . '</div>';
            case 'hold':
                return '<div class="badge badge-light-warning">' . ucfirst($status) . '</div>';
            case 'cancelled':
                return '<div class="badge badge-glow badge-danger">' . ucfirst($status) . '</div>';
            case 'cancel_accept_by_incharge':
                return '<div class="badge badge-glow badge-info">Cancel Accept By Incharge</div>';
            case 'hold_accept_by_incharge':
                return '<span class="badge badge-glow badge-primary">Hold Parcel In Office</span>';
            case 'cancel_accept_by_merchant':
                return '<div class="badge badge-glow badge-info">Cancel Accept By Merchant</div>';
        }
    }

    public function dataTableCustomerDetails($parcelDetails): string
    {
        if (isset($parcelDetails->sub_area)) {
            return '<b>Name: </b>' . $parcelDetails->customer_name . '<br><b>Mobile: </b>' . $parcelDetails->customer_mobile .
                '<br><b>Sub Area:</b>' . $parcelDetails->sub_area->name .
                '<br><b>Address: </b>' . $parcelDetails->customer_address;
        } else {
            return '<b>Name: </b>' . $parcelDetails->customer_name . '<br><b>Mobile: </b>' . $parcelDetails->customer_mobile .
                ')<br><b>Address: </b>' . $parcelDetails->customer_address;
        }
    }

    public function dataTableMerchantDetails($parcelDetails)
    {
        if (isset($parcelDetails->merchant)) {
            return '<b>Name: </b>' . $parcelDetails->merchant->name .
                '<br><b>Mobile: </b>' . $parcelDetails->merchant->mobile;
        } else {
            return '<i class="text-danger">No merchant found</i>';
        }
    }

    public function dataTablePaymentDetails($parcelDetails)
    {
        return '<b>Collection Amount: </b>' . $parcelDetails->collection_amount . ' tk <br><b>Delivery Charge: </b>'
            . $parcelDetails->delivery_charge . ' tk <br><b>COD: </b>' . $parcelDetails->cod . 'tk' . '<br><b>Payable: </b>' . $parcelDetails->payable . ' tk';
    }

    public function dataTableDateAndTime($parcelDetails)
    {
        $parcelDate = '';
        if (is_null($parcelDetails->added_date)) {
            $parcelDate = $parcelDetails->created_at->format('h:i A');
        } else {
            $parcelDate = Carbon::createFromFormat('Y-m-d', $parcelDetails->added_date)->format('d M Y');
        }
        return '<b>Parcel Date: </b>' . $parcelDate .
            //            '<br><b>Time: </b>' . $parcelDetails->created_at->format('h:i A') .
            '<br><b>Created: </b>' . $parcelDetails->created_at->diffForHumans();
    }

    protected function parcelNoteGuardId($guardName)
    {
        if ($guardName === 'admin') {
            return $id = 'admin_id';
        } elseif ($guardName === 'merchant') {
            return $id = 'merchant_id';
        } else {
            return $id = 'rider_id';
        }
    }

    public function createParcelNote($parcelId, $guardName, $note)
    {
        $this->parcelNote->createNote([
            'parcel_id' => $parcelId,
            'guard_name' => $guardName,
            $this->parcelNoteGuardId($guardName) => auth($guardName)->user()->id,
            'note' => $note,
        ]);
    }

    public function createNewParcel()
    {
        return [
            'merchants' => $this->merchantRepo->allMerchantList(),
            'city_types' => $this->cityTypeRepo->getAllCityTypes(),
            'parcel_types' => $this->parcelTypeRepo->allParcelTypeList(),
            'weight_ranges' => $this->weightRangeRepo->allWeightRangeList(),
        ];
    }

    public function storeParcel(array $requestData)
    {
        $merchant_id = $requestData['merchant_id'] ?? auth('merchant')->user()->id;
        $data = $requestData;
        $data['cod'] = $requestData['collection_amount'] * $requestData['cod'] / 100;
        $data['cod_percentage'] = $requestData['cod'];
        $data['payable'] = $requestData['collection_amount'] - ($requestData['collection_amount'] * $requestData['cod'] / 100) - $requestData['delivery_charge'];
        $data['invoice_id'] = getPrefix($merchant_id) . '-' . $requestData['invoice_id'];
        $data['tracking_id'] = \App\Classes\TrackingNumber::serial_number();
        $data['merchant_id'] = $merchant_id;
        $data['added_date'] = $requestData['added_date'] ? $requestData['added_date'] : date('Y-m-d');
        $data['hub_id'] = auth('admin')->user()->hub_id ?? 1;
        return $this->parcelRepo->createParcel($data);
    }



    public function createTime($parcelId, $statusType)
    {
        $this->parcelTimeRepo->createParcelTime([
            'parcel_id' => $parcelId,
            'time_type' => $statusType,
            'time' => Carbon::now(),
        ]);
    }

    public function partialDelivery(array $requestData, $parcelData)
    {
        $codCharge = ($requestData['partial_amount'] * $parcelData->cod_percentage) / 100;
        $data = [
            'parcel_id' => $parcelData->id,
            'amount' => $requestData['partial_amount'],
            'collection_amount' => $requestData['partial_amount'],
            'delivery_charge' => $parcelData->delivery_charge,
            'cod_charge' => $codCharge,
            'net_payable' => $requestData['partial_amount'] - ($parcelData->delivery_charge + $codCharge),
            'merchant_id' => $parcelData->merchant_id,
            'note' => $requestData['note'],
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_time' => Carbon::now(),
        ];
        try {
            DB::beginTransaction();
            $this->parcelRepo->updateParcel(['status' => 'partial','delivery_status' => 'partial', 'cancle_partial_invoice' => 'no', 'payment_status' => 'partial', 'payment_type' => 'cash_on_delivery', 'return_product' => $requestData['return_product']], $parcelData);
            $this->collectionRepo->createCollection($data);
            $this->createTime($parcelData->id, 'partial');
            if ($requestData['note'] !== null) {
                $this->createParcelNote($parcelData->id, 'rider', $requestData['note']);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
        }
    }

    public function fullDelivery($parcelData)
    {
        $data = [
            'parcel_id' => $parcelData->id,
            'amount' => $parcelData->collection_amount,
            'collection_amount' => $parcelData->collection_amount,
            'delivery_charge' => $parcelData->delivery_charge,
            'cod_charge' => $parcelData->cod,
            'net_payable' => $parcelData->collection_amount - ($parcelData->delivery_charge + $parcelData->cod),
            'merchant_id' => $parcelData->merchant_id,
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_time' => Carbon::now(),
        ];
        try {
            DB::beginTransaction();
            $this->parcelRepo->updateParcel(['status' => 'delivered','delivery_status' => 'delivered', 'payment_status' => 'paid', 'payment_type' => 'cash_on_delivery'], $parcelData);
            $this->collectionRepo->createCollection($data);
            $this->createTime($parcelData->id, 'delivered');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
        }
    }
    public function exchangeDelivery($parcelData)
    {
        $data = [
            'parcel_id' => $parcelData->id,
            'amount' => $parcelData->collection_amount,
            'collection_amount' => $parcelData->collection_amount,
            'delivery_charge' => $parcelData->delivery_charge,
            'cod_charge' => $parcelData->cod,
            'net_payable' => $parcelData->collection_amount - ($parcelData->delivery_charge + $parcelData->cod),
            'merchant_id' => $parcelData->merchant_id,
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_time' => Carbon::now(),
        ];
        try {
            DB::beginTransaction();
            $this->parcelRepo->updateParcel(['status' => 'exchange', 'delivery_status' => 'exchange', 'payment_status' => 'paid', 'payment_type' => 'cash_on_delivery', 'cancle_partial_invoice' => 'no'], $parcelData);
            $this->collectionRepo->createCollection($data);
            $this->createTime($parcelData->id, 'exchange');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
        }
    }

    public function mobileBanking($requestData, $parcelData)
    {
        //return $parcelData->collection_amount - $requestData['mobile_partial_amount'];
        $codCharge = ($requestData['mobile_partial_amount'] * $parcelData->cod_percentage) / 100;
        $collectionData = [
            'parcel_id' => $parcelData->id,
            'amount' => $requestData['mobile_partial_amount'],
            'collection_amount' => $requestData['mobile_partial_amount'],
            'delivery_charge' => $parcelData->delivery_charge,
            'cod_charge' => $codCharge,
            'net_payable' => $requestData['mobile_partial_amount'] - ($parcelData->delivery_charge + $codCharge),
            'merchant_id' => $parcelData->merchant_id,
            'note' => $requestData['mobile_note'],
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_time' => Carbon::now(),
        ];
        $merchant_mobile_banking_id = $requestData['merchant_mobile_banking_id'] ?? Null;
        $mobileBankingCollectionData = [
            'amount' => $requestData['mobile_banking_amount'],
            'collection_amount' => $requestData['mobile_banking_amount'],
            'parcel_id' => $parcelData->id,
            'mobile_banking_id' => $requestData['mobile_banking_id'],
            'merchant_mobile_banking_id' => $merchant_mobile_banking_id,
            'customer_mobile_number' => $requestData['customer_mobile_number'],
        ];
        try {
            $totalRequestAmount = $requestData['mobile_partial_amount'] + $requestData['mobile_banking_amount'];
            DB::beginTransaction();
            if ($requestData['mobile_return_product'] == 0 && $totalRequestAmount == $parcelData->collection_amount) {
                $this->parcelRepo->updateParcel(['status' => 'delivered', 'payment_status' => 'paid', 'payment_type' => 'mobile_banking'], $parcelData);
                $this->collectionRepo->createCollection($collectionData);
                $this->mobileBankingCollectionRepo->createMobileBankingCollection($mobileBankingCollectionData);
                if ($requestData['mobile_note'] !== null) {
                    $this->createParcelNote($parcelData->id, 'rider', $requestData['mobile_note']);
                }
                $this->createTime($parcelData->id, 'delivered');
            } elseif ($requestData['mobile_return_product'] > 0 && $totalRequestAmount < $parcelData->collection_amount) {
                $this->parcelRepo->updateParcel(['status' => 'partial', 'payment_status' => 'partial', 'payment_type' => 'mobile_banking', 'return_product' => $requestData['mobile_return_product']], $parcelData);
                $this->collectionRepo->createCollection($collectionData);
                $this->mobileBankingCollectionRepo->createMobileBankingCollection($mobileBankingCollectionData);
                if ($requestData['mobile_note'] !== null) {
                    $this->createParcelNote($parcelData->id, 'rider', $requestData['mobile_note']);
                }
                $this->createTime($parcelData->id, 'partial');
            } else {
                return response()->errorRedirect('Please Enter Right Information', 'rider.parcel.index');
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect('OPPS something wrong', 'rider.parcel.index');
        }
    }

    public function holdParcel($requestData, $parcel)
    {
        $data = $requestData->validated();
        $data['reasonable_id'] = $parcel->id;
        $data['reasonable_type'] = Parcel::class;
        $data['type'] = 'hold';
        $data['reason_type_id'] = $requestData->hold_reason;
        try {
            DB::beginTransaction();
            $this->parcelRepo->updateParcel(['delivery_status' => 'hold','status' => 'hold'], $parcel);
            $this->reasonRepo->createReason($data);
            $this->createTime($parcel->id, 'hold');
            if ($requestData['hold_note'] !== null) {
                $this->createParcelNote($parcel->id, 'rider', $requestData->hold_note);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::info($e->getMessage());
            return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
        }
    }

    public function cancelParcel($requestData, $parcelData)
    {
        $data = $requestData->validated();
        $data['reasonable_id'] = $parcelData->id;
        $data['reasonable_type'] = Parcel::class;
        $data['type'] = 'cancel';
        $data['reason_type_id'] = $requestData->cancel_reason;

        if ($parcelData->merchant->isReturnCharge === 'apply') {
            $deliveryChange = $parcelData->delivery_charge;
            $net_payable = 0 - $parcelData->delivery_charge;
        } else {
            $deliveryChange = 0;
            $net_payable = 0;
        }

        // if ($parcelData->merchant->isReturnCharge === 'apply') {
        //     $deliveryChange = $parcelData->delivery_charge;
        //     if ($requestData->cancel_collection >= $parcelData->delivery_charge) {
        //         $net_payable = 0;
        //     } else {
        //         $net_payable = 0 - $parcelData->delivery_charge;
        //     }
        // } else {
        //     $deliveryChange = 0;
        //     $net_payable = 0;
        // }
        $collectionData = [
            'parcel_id' => $parcelData->id,
            'amount' => $requestData->cancel_collection,
            'collection_amount' => 0,
            'cancle_amount' => $requestData->cancel_collection,
            'delivery_charge' => $deliveryChange,
            'cod_charge' => 0,
            //'net_payable' => ($requestData->cancel_collection) - ($deliveryChange + 0),
            'net_payable' => $net_payable,
            'merchant_id' => $parcelData->merchant_id,
            'rider_collected_by' => auth('rider')->user()->id,
            'rider_collected_time' => Carbon::now(),
            'note' => $requestData->cancel_note
        ];
        try {
            DB::beginTransaction();
            $this->parcelRepo->updateParcel(['status' => 'cancelled','delivery_status' => 'cancelled', 'cancle_partial_invoice' => 'no'], $parcelData);
            $this->reasonRepo->createReason($data);
            $this->collectionRepo->createCollection($collectionData);
            if ($requestData['cancel_note'] !== null) {
                $this->createParcelNote($parcelData->id, 'rider', $requestData->cancel_note);
            }
            $this->createTime($parcelData->id, 'cancelled');
            // ========
           // SmsSettingController::testSms($parcelData->id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect('Opps! something wrong', 'rider.parcel.index');
        }
    }
}
