<?php

namespace App\Http\Controllers\Merchant;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\services\ParcelService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ParcelRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\SubAreaInterface;

class ParcelRequestController extends Controller
{
    protected $parcelService;
    protected $subAreaRepo;

    public function __construct(ParcelService $service, SubAreaInterface $subArea)
    {
        $this->parcelService = $service;
        $this->subAreaRepo = $subArea;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $parcels = $this->parcelService->parcelRepo->allLatestParcelByMerchantBasis('wait_for_pickup');
            return DataTables::of($parcels)
                ->addIndexColumn()
                ->addColumn('customer_details', function ($parcel) {
                    return $this->parcelService->dataTableCustomerDetails($parcel);
                })
                ->addColumn('date_time', function ($parcel) {
                    return $this->parcelService->dataTableDateAndTime($parcel);
                })
                ->addColumn('payment_details', function ($parcel) {
                    return $this->parcelService->dataTablePaymentDetails($parcel);
                })
                ->addColumn('status', function ($parcel) {
                    return $this->parcelService->parcelShowStatus($parcel->status);
                })
                ->addColumn('action', function ($parcel) {
                    return view('merchant.parcel-request.action-button', compact('parcel'));
                })
                ->rawColumns(['customer_details', 'date_time', 'status', 'payment_details', 'action'])
                ->tojson();
        }
        return view('merchant.parcel-request.index');
    }

    public function edit($id)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($id);

        $data = $this->parcelService->createNewParcel();
        $data['parcel'] = $parcel;

        return view('merchant.parcel-request.edit', $data);
    }

    public function update(ParcelRequest $request, $id)
    {
        $parcel = $this->parcelService->parcelRepo->getAnInstance($id);
        $data = $request->validated();
        $data['payable'] = $request->collection_amount - ($request->collection_amount * $request->cod / 100) - $request->delivery_charge;
        $this->parcelService->parcelRepo->updateParcel($data, $parcel);
        return response()->successRedirect('Update successfully', 'merchant.parcel.request.index');

    }
    public function delete(Parcel $parcel_id)
    {
        $parcel_id->delete();
        return response()->successRedirect('Delete successfully', 'merchant.parcel.request.index');

    }
}
