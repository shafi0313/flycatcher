<?php

namespace App\services;

use App\Models\Collection;
use App\Models\Parcel;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\PickupRequestInterface;
use App\Repository\Interfaces\RiderInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    protected $collectionRepo;
    protected $parcelRepo;
    protected $pickupRepo;
    protected $adminRepo;
    protected $riderRepo;

    public function __construct(CollectionInterface $collection, ParcelInterface $parcel, PickupRequestInterface $pickupRequest, AdminInterface $admin, RiderInterface $rider)
    {
        $this->collectionRepo = $collection;
        $this->parcelRepo = $parcel;
        $this->pickupRepo = $pickupRequest;
        $this->adminRepo = $admin;
        $this->riderRepo = $rider;
    }

    public function countTotalParcel($requestData = [])
    {
        if(empty($requestData)){
            $total = $this->parcelRepo->parcelCountInDifferentStatus('');
//            return 'ok';
        }else{
//            return $requestData->hub_id;
            $total = $this->parcelRepo->parcelCountInDifferentStatus(['hub_id'=>$requestData['hub_id']]);
        }
        $waitForPickup = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'wait_for_pickup']);
        $receivedAtOffice = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'received_at_office']);
        $pending = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'pending']);
        $transit = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'transit']);
        $delivered = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'delivered']);
        $partial = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'partial']);
        $hold = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'hold']);
        $cancelled = $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancelled']) + $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_incharge']) + $this->parcelRepo->parcelCountInDifferentStatus(['status' => 'cancel_accept_by_merchant']);

        return [
            'total' => $total,
            'waitForPickup' => $waitForPickup,
            'receivedAtOffice' => $receivedAtOffice,
            'pending' => $pending,
            'transit' => $transit,
            'delivered' => $delivered,
            'partial' => $partial,
            'cancelled' => $cancelled,
            'hold' => $hold,

            'waitForPickupPercent' => $total>0? number_format(($waitForPickup * 100) / $total, 2):0,
            'receivedAtOfficePercent' => $total>0? number_format(($receivedAtOffice * 100) / $total, 2):0,
            'pendingPercent' => $total>0?number_format(($pending * 100) / $total, 2):0,
            'transitPercent' => $total>0?number_format(($transit * 100) / $total, 2):0,
            'deliveredPercent' => $total>0?number_format(($delivered * 100) / $total, 2):0,
            'partialPercent' => $total>0?number_format(($partial * 100) / $total, 2):0,
            'cancelledPercent' => $total>0?number_format(($cancelled * 100) / $total, 2):0,
            'holdPercent' => $total>0?number_format(($hold * 100) / $total, 2):0,
        ];
    }

    public function countParcelDaily()
    {
        $dailyTotal = $this->parcelRepo->dailyMonthlyYearlyParcelCount(['id', 'status', 'created_at'], [], 'added_date', Carbon::yesterday()->toDateString());
        $dailyParcelCreateByAdmin = $this->parcelRepo->dailyMonthlyYearlyParcelCount(['id', 'status', 'guard_name', 'added_by_admin', 'added_by_merchant', 'created_at'], ['guard_name' => 'admin', 'added_by_merchant' => null], 'added_date', Carbon::yesterday()->toDateString());
        $dailyParcelCreateByMerchant = $this->parcelRepo->dailyMonthlyYearlyParcelCount(['id', 'status', 'guard_name', 'added_by_admin', 'added_by_merchant', 'created_at'], ['guard_name' => 'merchant', 'added_by_admin' => null], 'added_date', Carbon::yesterday()->toDateString());
        return [
            'dailyTotal' => $dailyTotal,
            'dailyParcelCreateByAdmin' => $dailyParcelCreateByAdmin,
            'dailyParcelCreateByMerchant' => $dailyParcelCreateByMerchant,
            'percentDailyParcelCreatedByAdmin' => $dailyTotal > 0 ? number_format(($dailyParcelCreateByAdmin * 100) / $dailyTotal, 2) : 0,
            'percentDailyParcelCreatedByMerchant' => $dailyTotal > 0 ? number_format(($dailyParcelCreateByMerchant * 100) / $dailyTotal, 2) : 0,
        ];
    }

    public function totalPaymentForAccountant(): array
    {
        return [
            'totalDeliveryChargeForAccount' => $this->collectionRepo->totalAmount(['accounts_collected_status' => 'collected'], 'delivery_charge'),
            'totalNetPayableForAccount' => $this->collectionRepo->totalAmount(['accounts_collected_status' => 'collected'], 'net_payable'),
            'totalCodForAccount' => $this->collectionRepo->totalAmount(['accounts_collected_status' => 'collected'], 'cod_charge')
        ];
    }

    public function dailyPaymentForAccountant(): array
    {
        return [
            'todayDeliveryChargeForAccount' => Collection::whereDate('accounts_collected_time', Carbon::today())->where(['accounts_collected_status' => 'collected'])->sum('delivery_charge'),
            'todayNetPayableForAccount' => Collection::whereDate('accounts_collected_time', Carbon::today())->where(['accounts_collected_status' => 'collected'])->sum('net_payable'),
            'todayCodForAccount' => Collection::whereDate('accounts_collected_time', Carbon::today())->where(['accounts_collected_status' => 'collected'])->sum('cod_charge'),
            'todayCollectedAmountForAccount' => Collection::whereDate('accounts_collected_time', Carbon::today())->where(['accounts_collected_status' => 'collected'])->sum('amount'),

        ];
    }

    public function totalPaymentForIncharge(): array
    {
        return [
            'totalCollectedAmountForIncharge' => $this->collectionRepo->totalAmount([
                'incharge_collected_by' => auth('admin')->user()->id,
                'incharge_collected_status' => 'collected'
            ], 'amount'),
            'totalRequestedAmountForIncharge' => $this->collectionRepo->totalAmount([
                'incharge_collected_by' => auth('admin')->user()->id,
                'incharge_collected_status' => 'transfer_request'
            ], 'amount'),
            'totalCollectedAmountForAccount' => $this->collectionRepo->totalAmount([
                'accounts_collected_by' => auth('admin')->user()->id,
                'accounts_collected_status' => 'collected'
            ], 'amount'),
        ];
    }

    public function lastThirtyDaysParcelCount()
    {
       return Parcel::select([
            DB::raw('DATE(added_date) AS date'),
            DB::raw('COUNT(id) AS count'),
        ])->where('status', '<>' , 'wait_for_pickup')->whereBetween('added_date', [Carbon::now()->subDays(30), Carbon::now()])->groupBy('date')->orderBy('date', 'ASC')->get();
    }
}
