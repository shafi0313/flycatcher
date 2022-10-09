<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RiderAssignRequest;
use App\Models\PickupRequest;
use App\Models\ParcelType;
use App\Repository\Interfaces\PickupRequestInterface;
use App\Repository\Interfaces\RiderInterface;
use App\services\PickupRequestService;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class PickupRequestController extends Controller
{
    protected $pickupRequestRepo;
    protected $riderRepo;
    protected $pickupRequestService;
    public function __construct(PickupRequestInterface $pickupRequest, RiderInterface $rider, PickupRequestService $pickupRequestService)
    {
        $this->pickupRequestRepo = $pickupRequest;
        $this->riderRepo = $rider;
        $this->pickupRequestService = $pickupRequestService;
    }

    public function index()
    {
        if(isset(\request()->status)){
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition(['status'=>\request()->status]);
        }else{
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition('');
        }
        $riders = $this->riderRepo->allRiderList();
        if (\request()->ajax()) {
            return DataTables::of($pickupRequests)
                ->addIndexColumn()

                ->addColumn('merchant_details', function ($pickupRequest) {
                    return $this->pickupRequestService->dataTableMerchantRequest($pickupRequest);
                })
                ->addColumn('created_time', function ($pickupRequest) {
                    return $this->pickupRequestService->dataTableDateTime($pickupRequest);
                })
                ->addColumn('status', function ($pickupRequest) {
                    return showStatus($pickupRequest->status);
                })
                ->addColumn('admin_assign', function ($pickupRequest) use($riders) {
                    if($pickupRequest->status === 'pending') {
                        return view('admin.pickup.assign-rider', compact('pickupRequest', 'riders'));
                    }else{
                        return $this->pickupRequestService->assignRiderInfo($pickupRequest);
                    }
                })
                ->addColumn('action', function ($pickupRequest) {
                    return view('admin.pickup.action-button', compact('pickupRequest'));
                })
                ->addColumn('total_pickup_parcel', function ($pickupRequest) {
                    return '<b>'.$this->pickupRequestRepo->totalPickupParcel($pickupRequest->merchant_id).'</b>';
                })
                ->rawColumns(['merchant_details','created_time', 'admin_assign','status', 'action', 'total_pickup_parcel'])
                ->tojson();
        }
        $data = [
            'status'=>\request()->status,
            'total'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(''),
            'pending'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'pending']),
            'assigned'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'assigned']),
            'picked'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'picked']),
            'cancelled'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'cancelled']),
        ];
        return view('admin.pickup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'model' => new PickupRequest(),
            'types' => ParcelType::latest('id')->get(),
        ];
        return view('admin.pickup.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
       $pickupRequest= new PickupRequest();
       $pickupRequest->fill($request->all());
       $pickupRequest->merchant_id=Auth::guard('merchant')->id();
       $pickupRequest->save();
       Toastr::success('Pickup Request successfully Send!.', '', ["progressBar" => true]);
       return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param PickupRequest $pickupRequest
     * @return Response
     */
    public function show(PickupRequest $pickupRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param PickupRequest $pickupRequest
     * @return Response
     */
    public function edit(PickupRequest $pickupRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param PickupRequest $pickupRequest
     * @return Response
     */
    public function update(Request $request, PickupRequest $pickupRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PickupRequest $pickupRequest
     * @return RedirectResponse
     */
    public function destroy(PickupRequest $pickupRequest): RedirectResponse
    {
        $this->pickupRequestRepo->deletePickupRequest($pickupRequest);
        return response()->successRedirect('Pickup Request Deleted Successfully!.', 'admin.pickup-request.index');
    }

    public function riderAssign(RiderAssignRequest $request, $pickupId){
        $data =[
            'assigned_by'=>auth('admin')->user()->id,
            'assigning_by' =>$request->rider_id,
            'status'=>'assigned',
            'assigning_time'=>Carbon::now(),
        ];
        $pickupRequest = $this->pickupRequestRepo->getAnInstance($pickupId);
        $this->pickupRequestRepo->updatePickupRequest($data, $pickupRequest);
        return response()->successRedirect('Rider Assigned Successfully', 'admin.pickup-request.index');
    }

}
