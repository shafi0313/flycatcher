<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\MerchantRequest;
use App\Models\Merchant;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ParcelInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MerchantController extends Controller
{
    protected $merchantRepo;
    protected $areaRepo;
    protected $parcelRepo;

    public function __construct(AreaInterface $areaInterface, MerchantInterface $merchantInterface, ParcelInterface $parcel)
    {
        $this->merchantRepo = $merchantInterface;
        $this->areaRepo = $areaInterface;
        $this->parcelRepo = $parcel;
    }

    protected function merchantStatus($status)
    {
    }
    public function index()
    {
        if (\request()->status === 'active') {
            $merchants = $this->merchantRepo->allLeastestMerchant('1', 'active');
        } elseif (\request()->status === 'pending') {
            $merchants = $this->merchantRepo->allLeastestMerchant('0', 'pending');
        } elseif (\request()->status === 'inactive') {
            $merchants = $this->merchantRepo->allLeastestMerchant('0', 'inactive');
        } else {
            $merchants = $this->merchantRepo->allLeastestMerchant('1', '');
        }
        if (\request()->ajax()) {
            return DataTables::of($merchants)
                ->addIndexColumn()
                ->addColumn('merchant_info', function ($merchant) {
                    return '<b>Name:</b>' . $merchant->name .
                        '<br><b>Prefix: </b>' . $merchant->prefix .
                        '<br><b>Mobile:</b>' . $merchant->mobile .
                        '<br><b>Email:</b>' . $merchant->email;
                })
                ->addColumn('area_info', function ($merchant) {
                    if (isset($merchant->area)) {
                        return $merchant->area->area_name . ' (' . $merchant->area->area_code . ')';
                    } else {
                        return '<div class="text-danger">Not Set</div>';
                    }
                })

                ->addColumn('parcel_info', function ($merchant) {
                    return '<b>All:</b> ' . $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => $merchant->id]) .
                        '<br><b>Pending:</b> ' . $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => $merchant->id, 'status' => 'pending']) .
                        '<br><b>Transit:</b> ' . $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => $merchant->id, 'status' => 'transit']) .
                        '<br><b>Hold:</b> ' . $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => $merchant->id, 'status' => 'hold']) .
                        '<br><b>Cancel:</b> ' . $this->parcelRepo->parcelCountInDifferentStatus(['merchant_id' => $merchant->id, 'status' => 'cancelled']);
                })

                ->addColumn('enableDisable', function ($merchant) {
                    return showStatus($merchant->is_active);
                })
                ->addColumn('status', function ($merchant) {
                    return showStatus($merchant->status);
                })
                ->addColumn('cancel_charge', function ($merchant) {
                    if (!empty($merchant->isReturnCharge)) {
                        if ($merchant->isReturnCharge === 'apply') {
                            return '<div class="badge badge-primary">Apply</div>';
                        } else {
                            return '<div class="badge badge-danger">Not Apply</div>';
                        }
                    } else {
                        return '<b class="text-danger">Not set yet</b>';
                    }
                })
                ->addColumn('action', function ($merchant) {
                    return view('admin.merchant.info.action-button', compact('merchant'));
                })
                ->rawColumns(['area_info', 'merchant_info', 'parcel_info', 'enableDisable', 'status', 'action', 'cancel_charge'])
                ->tojson();
        }

        $data = [
            'status' => \request()->status,
            'all' => $this->merchantRepo->countMerchantWithCondition(''),
            'pending' => $this->merchantRepo->countMerchantWithCondition(['status' => 'pending']),
            'active' => $this->merchantRepo->countMerchantWithCondition(['status' => 'active']),
            'inactive' => $this->merchantRepo->countMerchantWithCondition(['status' => 'inactive']),
        ];
        return view('admin.merchant.info.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['areas'] = $this->areaRepo->allAreaList();
        return view('admin.merchant.info.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MerchantRequest $request)
    {
        $data = $request->validated();
        $data['password'] = bcrypt('12345678');
        $data['status'] = 'active';
        $data['isActive'] = 1;
        $data['created_by'] = auth('admin')->user()->id;
        $data['hub_id'] = auth('admin')->user()->hub_id ?? 1;
        $this->merchantRepo->createMerchant($data);
        Toastr::success('New merchant added successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.merchant.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Merchant $merchant
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $data['merchant'] = $this->merchantRepo->merchantDetailsInstance($id);
        return view('admin.merchant.info.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'areas' => $this->areaRepo->allAreaList(),
            'merchant' => $this->merchantRepo->getAnInstance($id),
        ];

        return view('admin.merchant.info.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MerchantRequest $request
     * @param Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function update(MerchantRequest $request, Merchant $merchant)
    {
        $this->merchantRepo->updateMerchant($request->validated(), $merchant);
        return response()->successRedirect('Info updated !', 'admin.merchant.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Merchant $merchant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->merchantRepo->deleteMerchant($id);
        Toastr::success('Merchant Information deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.merchant.index');
    }

    public function pending($id)
    {
        $merchant = $this->merchantRepo->getAnInstance($id);
        $this->merchantRepo->statusChange($merchant, 'active', '1');
        Toastr::success('Merchant Approved Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.merchant.index');
    }

    public function active($id)
    {
        $merchant = $this->merchantRepo->getAnInstance($id);
        $this->merchantRepo->statusChange($merchant, 'inactive', '0');
        Toastr::success('Merchant Inactive Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.merchant.index');
    }

    public function inactive($id)
    {
        $merchant = $this->merchantRepo->getAnInstance($id);
        $this->merchantRepo->statusChange($merchant, 'active', '1');
        Toastr::success('Merchant Active Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.merchant.index');
    }
    public function login($merchantId)
    {
        $data['merchant'] = \auth('merchant')->loginUsingId($merchantId);
        session(['loggedIn-from-admin' => true]);
        return redirect()->route('merchant.dashboard');
    }
}
