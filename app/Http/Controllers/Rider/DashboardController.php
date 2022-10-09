<?php

namespace App\Http\Controllers\Rider;

use App\Http\Controllers\Controller;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\CollectionInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $collectionRepo;
    protected $adminRepo;

    public function __construct(CollectionInterface $collection, AdminInterface $admin)
    {
        $this->collectionRepo = $collection;
        $this->adminRepo = $admin;
    }

    public function dashboard()
    {
        $data['totalCollectedAmount'] = $this->collectionRepo->totalAmount([
            'rider_collected_by'=>auth('rider')->user()->id,
            'rider_collected_status'=>'collected'
        ], 'amount');
        $data['totalRequestedAmountForTransaction'] = $this->collectionRepo->totalAmount([
            'rider_collected_by'=>auth('rider')->user()->id,
            'rider_collected_status'=>'transfer_request'
        ], 'amount');
        $data['incharges'] = $this->adminRepo->getAdminWithSpecificRole(['name'=>'Incharge', 'guard_name'=>'admin'], ['isActive'=>1,'collection'=>1]);
        return view('rider.dashboard.dashboard', $data);
    }
}
