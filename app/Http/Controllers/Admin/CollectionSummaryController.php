<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Collection;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\CollectionInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CollectionSummaryController extends Controller
{
    protected $collectionRepo;
    protected $adminRepo;
    public function __construct(CollectionInterface $collection, AdminInterface $admin)
    {
        $this->collectionRepo = $collection;
        $this->adminRepo = $admin;
    }

    public function index()
    {
        $incharges = $this->adminRepo->getAdminWithSpecificRole(['name'=>'Incharge', 'guard_name'=>'admin'], ['isActive'=>1]);
        //return Admin::with('rider_collection_transfer_for_incharge')->get();
        if (\request()->ajax()) {
            $riders = Rider::with('collections')->where(['status' => 'active'])->latest('id');
            return DataTables::of($riders)
                ->addIndexColumn()
                ->addColumn('rider_name', function ($rider) {
                    return $rider->name;
                })
                ->addColumn('current_balance', function ($rider) {
                    return number_format(Collection::where(['rider_collected_by' => $rider->id, 'rider_collected_status' => 'collected'])->sum('amount'));
                })
                ->addColumn('transfer_request', function ($rider) {
                    return number_format(Collection::where(['rider_collected_by' => $rider->id, 'rider_collected_status' => 'transfer_request'])->sum('amount'));
//                     return $plucks = $collections->pluck('rider_collection_transfer_for');
//                    $uniqueCollection = $plucks->unique();
//                   return $uniqueCollection->all();
                })
                ->rawColumns(['currently_collected', 'transfer_request', 'rider_name'])
                ->tojson();
        }

        return view('admin.collection.summary',compact('incharges'));
    }
}
