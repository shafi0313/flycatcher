<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParcelReassign;
use App\Repository\Interfaces\RiderInterface;
use App\Http\Requests\StoreParcelReassignRequest;
use App\Http\Requests\UpdateParcelReassignRequest;
use App\Models\Parcel;

class ParcelReassignController extends Controller
{

    protected $riderRepo;

    public function __construct(RiderInterface $rider)
    {

        $this->riderRepo = $rider;
    }
    public function index()
    {
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.parcel-reassign.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreParcelReassignRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->items as $key => $item) {
          //  dd($item['parcel_id']);
            $parcel = Parcel::find($item['parcel_id']);
            $parcel->assigning_by = $request->to_rider_id;
            $parcel->save();
        }
        return response()->successRedirect('Re-Assign Successfully Done!.', '');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ParcelReassign  $parcelReassign
     * @return \Illuminate\Http\Response
     */
    public function show(ParcelReassign $parcelReassign)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ParcelReassign  $parcelReassign
     * @return \Illuminate\Http\Response
     */
    public function edit(ParcelReassign $parcelReassign)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateParcelReassignRequest  $request
     * @param  \App\Models\ParcelReassign  $parcelReassign
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateParcelReassignRequest $request, ParcelReassign $parcelReassign)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ParcelReassign  $parcelReassign
     * @return \Illuminate\Http\Response
     */
    public function destroy(ParcelReassign $parcelReassign)
    {
        //
    }
}
