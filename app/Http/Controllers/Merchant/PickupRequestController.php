<?php

namespace App\Http\Controllers\Merchant;

use App\Models\PickupRequest;
use App\Models\ParcelType;
use App\Repository\Interfaces\PickupRequestInterface;
use App\services\PickupRequestService;
use Brian2694\Toastr\Facades\Toastr;
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
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition(['status'=>\request()->status, 'merchant_id'=>\auth('merchant')->user()->id]);
        }else{
            $pickupRequests = $this->pickupRequestRepo->latestPickupRequestWithCondition(['merchant_id'=>\auth('merchant')->user()->id]);
        }

        if (\request()->ajax()) {
            return DataTables::of($pickupRequests)
                ->addIndexColumn()


                ->addColumn('created_time', function ($pickupRequest) {
                    return $this->pickupRequestService->dataTableDateTime($pickupRequest);
                })
                ->addColumn('status', function ($pickupRequest) {
                    return showStatus($pickupRequest->status);
                })

                ->addColumn('assign_option', function ($pickupRequest)  {
                    if(auth()->guard('merchant')->check()){
                        if($pickupRequest->status === 'pending') {
                            return '<div class="badge badge-info">Your Pickup Request Is Precessing</div>';
                        }else{
                            return $this->pickupRequestService->assignRiderInfo($pickupRequest);
                        }
                    }
                })

                ->rawColumns(['merchant_details','created_time', 'assign_option', 'status'])
                ->tojson();
        }
        $data = [
            'status'=>\request()->status,
            'total'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['merchant_id'=>\auth('merchant')->user()->id]),
            'pending'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'pending','merchant_id'=>\auth('merchant')->user()->id]),
            'assigned'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'assigned','merchant_id'=>\auth('merchant')->user()->id]),
            'accepted'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'accepted','merchant_id'=>\auth('merchant')->user()->id]),
            'picked'=>$this->pickupRequestRepo->pickupRequestCountInDifferentStatus(['status'=>'picked','merchant_id'=>\auth('merchant')->user()->id]),
        ];
        return view('merchant.pickup.index', $data);
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
        return view('merchant.pickup.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $exit = PickupRequest::where('merchant_id', Auth::guard('merchant')->id())
            ->where('status', '!=', 'picked')
            ->where('status', '!=', 'cancelled')
            ->count();
        if ($exit > 0) {
            Toastr::info('PickupRequest Already Sent!.', '', ["progressBar" => true]);
            return redirect()->back();
        } else {
            $pickupRequest = new PickupRequest();
            $pickupRequest->fill($request->all());
            $pickupRequest->merchant_id = Auth::guard('merchant')->id();
            $pickupRequest->save();
            Toastr::success('PickupRequest successfully Send!.', '', ["progressBar" => true]);
            return redirect()->back();
        }
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
        Toastr::success('Pickup Request Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('merchant.pickup-request.index');
    }
}
