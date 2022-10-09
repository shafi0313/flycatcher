<?php

namespace App\Http\Controllers\Rider;

use App\Models\PickupRequest;
use App\Models\ParcelType;
use App\Repository\Interfaces\PickupRequestInterface;
use App\services\PickupRequestService;
use App\traits\PickupRequestTrait;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\WeightRange;
use Yajra\DataTables\Facades\DataTables;

class PickupRequestController extends Controller
{
    protected $pickupRequestRepo;
    protected $pickupRequestService;

    public function __construct(PickupRequestInterface $pickupRequestInterface, PickupRequestService $pickupRequestService)
    {
        $this->pickupRequestRepo = $pickupRequestInterface;
        $this->pickupRequestService = $pickupRequestService;
    }
    public function index()
    {
        if(isset(\request()->status)){
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition(['status'=>\request()->status, 'assigning_by'=>\auth('rider')->user()->id]);
        }else{
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition(['assigning_by'=>\auth('rider')->user()->id]);
        }

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

                ->addColumn('rider_assign', function ($pickupRequest) {
                    if(isset($pickupRequest->admin)){
                        return ' <br><b>Assigned By:</b> ' .$pickupRequest->admin->name.
                            '<br><b>Assign time:</b> ' . $pickupRequest->assigning_time.
                            '<br><b>Accepted time:</b> ' . $pickupRequest->accepted_time.
                            '<br><b>Picked time:</b> ' .$pickupRequest->picked_time;
                    }else{
                         return ' <br><b>Assigned By:</b> Not found'.
                            '<br><b>Assign time:</b> ' . $pickupRequest->assigning_time.
                            '<br><b>Accepted time:</b> ' . $pickupRequest->accepted_time.
                            '<br><b>Picked time:</b> ' .$pickupRequest->picked_time;
                    }
                })
                ->addColumn('action', function ($pickupRequest) {
                    return view('rider.pickup.action-button', compact('pickupRequest'));
                })
                ->addColumn('total_pickup_parcel', function ($pickupRequest) {
                    return '<b>'.$this->pickupRequestRepo->totalPickupParcel($pickupRequest->merchant_id).'</b>';
                })
                ->rawColumns(['merchant_details','created_time', 'rider_assign','status', 'action', 'total_pickup_parcel'])
                ->tojson();
        }
        $data = [
            'status'=>\request()->status,
            'total'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['assigning_by'=>\auth('rider')->user()->id]),
            'assigned'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'assigned','assigning_by'=>\auth('rider')->user()->id]),
            'accepted'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'accepted','assigning_by'=>\auth('rider')->user()->id]),
            'picked'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'picked','assigning_by'=>\auth('rider')->user()->id]),
        ];
        return view('rider.pickup.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $data = [
            'model' => new PickupRequest(),
            'types' => ParcelType::latest('id')->get(),
            'weight_ranges' => WeightRange::latest('id')->get(),
        ];
        return view('rider.pickup.create', $data);
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
       $pickupRequest->rider_id=Auth::guard('rider')->id();
       $pickupRequest->save();
       Toastr::success('PickupRequest successfully Send!.', '', ["progressBar" => true]);
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
    public function destroy(PickupRequest $pickupRequest):RedirectResponse
    {
        $this->pickupRequestRepo->deletePickupRequest($pickupRequest);
        Toastr::success('Pickup Request Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('rider.pickup-request.index');
    }

    public function delivered($id){

    }

    public function accept($pickupId){
        $data =[
            'accepted_time'=>Carbon::now(),
            'status'=>'accepted',
        ];
        $pickupRequest = $this->pickupRequestRepo->getAnInstance($pickupId);
        $this->pickupRequestRepo->updatePickupRequest($data, $pickupRequest);
        return response()->successRedirect('Pickup request accepted successfully', 'rider.pickup-request.index');
    }

    public function pickup($pickupId){
        $data =[
            'picked_time'=>Carbon::now(),
            'status'=>'picked',
        ];
        $pickupRequest = $this->pickupRequestRepo->getAnInstance($pickupId);
        $this->pickupRequestRepo->updatePickupRequest($data, $pickupRequest);
        return response()->successRedirect('Parcel picked successfully', 'rider.pickup-request.index');
    }
}
