<?php

namespace App\Http\Controllers;

use App\Http\Requests\AreaRequest;
use App\Models\Admin\Rider;
use App\Models\Area;
use App\Models\CityType;
use App\Models\Upazila;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\CityTypeInterface;
use App\Repository\Interfaces\LocationInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\View\Components\ActionComponent;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class AreaController extends Controller
{
    protected $areaRepo;
    protected $subAreaRepo;
    protected $cityTypeRepo;
    protected $locationRepo;
    protected $parcelRepo;

    public function __construct(CityTypeInterface $cityTypeInterface, AreaInterface $areaInterface, SubAreaInterface $subArea, LocationInterface $locationInterface, ParcelInterface $parcel)
    {
        $this->areaRepo = $areaInterface;
        $this->subAreaRepo = $subArea;
        $this->locationRepo = $locationInterface;
        $this->cityTypeRepo = $cityTypeInterface;
        $this->parcelRepo = $parcel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $areas = $this->areaRepo->allLeastestArea();
            return DataTables::of($areas)
                ->addIndexColumn()
                ->addColumn('city_name', function ($area) {
                    return $area->city->name;
                })
                ->addColumn('area_info', function ($area) {
                    $subAreas = $this->subAreaRepo->getSubAreaWithCondition(['area_id' => $area->id, 'status' => 'active']);
                    return view('admin.area.show', compact('area', 'subAreas'));
                })
                ->addColumn('status', function ($area) {
                    return showStatus($area->status);
                })
                ->addColumn('action', function ($area) {
                    return view('admin.area.action-button', compact('area'));
                })
                ->rawColumns(['status', 'area_info', 'rider_info', 'city_name', 'parcel_info', 'action'])
                ->tojson();
        }
        return view('admin.area.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = [
            'cityTypes' => $this->cityTypeRepo->getAllCityTypes(),
            'upazilas' => $this->locationRepo->getupazillas(),
            'districts' => $this->locationRepo->getDistricts(),
        ];
        return view('admin.area.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    protected function areaCommonInfo($request)
    {
        return [
            'city_type_id' => $request->city_type_id,
            'district_id' => $request->district_id,
            'upazila_id' => $request->upazila_id,
            'area_name' => $request->area_name,
            'area_code' => $request->area_code,
        ];
    }

    public function store(AreaRequest $request)
    {
        $data = $this->areaCommonInfo($request);
        $this->areaRepo->createArea($data);
        Toastr::success('Area Information Created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'cityTypes' => $this->cityTypeRepo->getAllCityTypes(),
            'area' => $this->areaRepo->getAnInstance($id),
            'upazilas' => $this->locationRepo->getupazillas(),
            'districts' => $this->locationRepo->getDistricts(),
        ];

        return view('admin.area.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $data = array_merge($this->areaCommonInfo($request), ['status' => $request->status]);
        $this->areaRepo->updateArea($data, $id);
        Toastr::success('Area Information updated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Area $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->areaRepo->deleteArea($id);
        Toastr::success('Area Information deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.area.index');
    }


}
