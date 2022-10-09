<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryChargeRequest;
use App\Models\DeliveryCharge;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\DeliveryChargeInterface;
use App\Repository\Interfaces\WeightRangeInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DeliveryChargeController extends Controller
{
    protected $cityTypeRepo;
    protected $weightRangeRepo;
    protected $deliveryChargeRepo;
    public function __construct(CityTypeInterface $cityTypeInterface, WeightRangeInterface $weightRangeInterface, DeliveryChargeInterface $deliveryChargeInterface)
    {
        $this->cityTypeRepo = $cityTypeInterface;
        $this->weightRangeRepo = $weightRangeInterface;
        $this->deliveryChargeRepo = $deliveryChargeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $charges = $this->deliveryChargeRepo->allLatestGlobalDeliveryCharge();
        if (\request()->ajax()) {
            return DataTables::of($charges)
                ->addIndexColumn()
                ->addColumn('weight_ranges', function ($charge) {
                    return $charge->weightRange->min_weight.' - '.$charge->weightRange->max_weight. '(KG)';
                })
                ->addColumn('cod_charge', function ($charge) {
                    return $charge->cod.'(%)';
                })
                ->addColumn('status', function ($charge) {
                    return showStatus($charge->status);
                })
                ->addColumn('action', function ($charge) {
                    return view('admin.delivery-charge.action-button', compact('charge'));
                })
                ->rawColumns(['weight_ranges', 'cod_charge','status', 'action'])
                ->tojson();
        }
        return view('admin.delivery-charge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
          'weightRanges' =>$this->weightRangeRepo->allWeightRangeList(),
            'cityTypes'=>$this->cityTypeRepo->getAllCityTypes(),
        ];
        return view('admin.delivery-charge.create', $data);
    }



    public function store(DeliveryChargeRequest $request)
    {
        $this->deliveryChargeRepo->createDeliveryCharge($request->all());
        Toastr::success('Delivery Charge Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.delivery-charge.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function show(DeliveryCharge $deliveryCharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveryCharge $deliveryCharge)
    {
        $data =[
            'weightRanges' =>$this->weightRangeRepo->allWeightRangeList(),
            'cityTypes'=>$this->cityTypeRepo->getAllCityTypes(),
            'charge'=>$deliveryCharge,
        ];

        return view('admin.delivery-charge.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveryCharge  $deliveryCharge
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryChargeRequest $request, DeliveryCharge $deliveryCharge)
    {
        $this->deliveryChargeRepo->updateDeliveryCharge($request->all(), $deliveryCharge);
        return response()->successRedirect('Delivery Charge updated', 'admin.delivery-charge.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveryCharge  $deliveryCharge
     * @return RedirectResponse
     */
    public function destroy(DeliveryCharge $deliveryCharge)
    {
        $this->deliveryChargeRepo->deleteDeliveryCharge($deliveryCharge);
        return response()->successRedirect('Delivery Charge deleted', '');
    }
}
