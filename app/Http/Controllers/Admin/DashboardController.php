<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hub;
use App\Models\ParcelTime;
use App\Repository\Interfaces\RiderInterface;
use App\services\DashboardService;
use Carbon\Carbon;
use App\Models\Admin;
use App\Models\Parcel;
use App\Models\Collection;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\PickupRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Rider;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\CollectionInterface;
use App\Repository\Interfaces\PickupRequestInterface;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Null_;

class DashboardController extends Controller
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

    public function dashboard(DashboardService $service)
    {
        foreach ($service->countParcelDaily() as $key => $daily) {
            $data[$key] = $daily;
        }

        foreach ($service->countTotalParcel([]) as $key => $total) {
            $data[$key] = $total;
        }

        foreach ($service->totalPaymentForAccountant() as $key => $total) {
            $data[$key] = $total;
        }

        foreach ($service->dailyPaymentForAccountant() as $key => $total) {
            $data[$key] = $total;
        }

        foreach ($service->totalPaymentForIncharge() as $key => $total) {
            $data[$key] = $total;
        }
        $lastMonthCount = [];
        $lastMonthDate = [];

        foreach ($service->lastThirtyDaysParcelCount() as $parcel) {
            array_push($lastMonthCount, $parcel->count);
            array_push($lastMonthDate, strval($parcel->date));
        }
        $data['accountants'] = $this->adminRepo->getAdminWithSpecificRole(['name' => 'Accountant', 'guard_name' => 'admin'], ['isActive' => 1]);
        $data['hubs'] = Hub::select(['id', 'name'])->get();
        //$data['riders'] = Admin\Rider::all();
        $data['lastMontRecords'] = implode(',', $lastMonthCount);
        $data['lastMontDates'] = $lastMonthDate;

        return view('admin.dashboard.dashboard', $data);
    }

    public function parcelSummarySearchByHub(Request $request, DashboardService $service){
        if(\request()->ajax()){
            foreach ($service->countTotalParcel($request) as $key => $total) {
                $data[$key] = $total;
            }
            return response()->view('admin.dashboard.parcel-summary-by-hub', $data);
        }
    }
}
