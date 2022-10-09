<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubAreaRequest;
use App\Models\SubArea;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\ParcelInterface;
use App\Repository\Interfaces\SubAreaInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubAreaController extends Controller
{
    protected $subAreaRepo;
    protected $areaRepo;
    protected $parcelRepo;

    public function __construct(SubAreaInterface $subArea, AreaInterface $area, ParcelInterface $parcel)
    {
        $this->subAreaRepo = $subArea;
        $this->areaRepo = $area;
        $this->parcelRepo = $parcel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $subAreas = $this->subAreaRepo->allLatestSubArea();
        if (\request()->ajax()) {
            return DataTables::of($subAreas)
                ->addIndexColumn()
                ->addColumn('area_info', function ($subArea) {
                    return '<b>Area Name:</b>'.$subArea->area->area_name.
                        '<br><b>Area Code:</b>'.$subArea->area->area_code;
                })

                ->addColumn('parcel_info', function ($subArea) {
                    return '<b>All:</b> '.$this->parcelRepo->parcelCountInDifferentStatus(['sub_area_id'=>$subArea->id]).
                        '<br><b>Pending:</b> '.$this->parcelRepo->parcelCountInDifferentStatus(['sub_area_id'=>$subArea->id, 'status'=>'pending']).
                        '<br><b>Transit:</b> '.$this->parcelRepo->parcelCountInDifferentStatus(['sub_area_id'=>$subArea->id, 'status'=>'transit']).
                        '<br><b>Hold:</b> '.$this->parcelRepo->parcelCountInDifferentStatus(['sub_area_id'=>$subArea->id, 'status'=>'hold']).
                        '<br><b>Cancel:</b> '.$this->parcelRepo->parcelCountInDifferentStatus(['sub_area_id'=>$subArea->id, 'status'=>'cancelled']);
                })
                ->addColumn('rider_info', function ($area) {
                    if(isset($area->assign_sub_area)){
                        return '<b>Name:</b> '.$area->assign_sub_area->assignable->name.
                            '<br><b>Mobile:</b> '.$area->assign_sub_area->assignable->mobile;
                    }else{
                        return '<i>Rider not set</i>';
                    }
                })
                ->addColumn('status', function ($subArea) {
                    return showStatus($subArea->status);
                })
                ->addColumn('action', function ($subArea) {
                    return view('admin.sub-area.action-button', compact('subArea'));
                })
                ->rawColumns(['status', 'area_info', 'parcel_info', 'rider_info'])
                ->tojson();
        }
        return view('admin.sub-area.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['areas'] = $this->areaRepo->allAreaList();
        return view('admin.sub-area.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SubAreaRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubAreaRequest $request)
    {
        $this->subAreaRepo->createSubArea($request->validated());
        return response()->successRedirect('New Sub Area Created !','admin.sub-area.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(SubArea $subArea)
    {
        $data = [
            'areas'=>$this->areaRepo->allAreaList(),
            'subArea' =>$subArea,
        ];
        return view('admin.sub-area.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubAreaRequest $request, SubArea $subArea)
    {
        $this->subAreaRepo->updateSubArea($request->validated(), $subArea);
        return response()->successRedirect('Sub Area Info Updated !','admin.sub-area.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubArea $subArea)
    {
        $this->subAreaRepo->deleteSubArea($subArea);
        return response()->successRedirect('Info Deleted Successfully !','admin.sub-area.index');
    }
}
