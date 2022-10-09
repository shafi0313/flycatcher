<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\ParcelTypeRequest;
use App\Repository\Interfaces\ParcelTypeInterface;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParcelTypeController extends Controller
{
    protected $parcelTypeRepo;

    public function __construct(ParcelTypeInterface $parcelTypeInterface)
    {
        $this->parcelTypeRepo = $parcelTypeInterface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $parcelTypes = $this->parcelTypeRepo->allLatestParcelType();
        if (\request()->ajax()) {
            return DataTables::of($parcelTypes)
                ->addIndexColumn()
                ->addColumn('status', function ($parcelType) {
                    return showStatus($parcelType->status);
                })
                ->addColumn('action', function ($parcelType) {
                    return view('admin.parcel-type.action-button', compact('parcelType'));
                })
                ->rawColumns(['status', 'action'])
                ->tojson();
        }
        return view('admin.parcel-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.parcel-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParcelTypeRequest $request)
    {
        $this->parcelTypeRepo->createParcelType([
            'name'=>$request->name,
        ]);
        Toastr::success('Parcel type info created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.parcel-type.index');
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
    public function edit($id)
    {
        $data['parcelType'] = $this->parcelTypeRepo->getAnInstance($id);
        return view('admin.parcel-type.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ParcelTypeRequest $request, $id)
    {
        $data = [
            'name'=>$request->name,
            'status'=>$request->status,
        ];
        $this->parcelTypeRepo->updateParcelType($data, $id);
        Toastr::success('Parcel type updated successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.parcel-type.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->parcelTypeRepo->deleteParcelType($id);
        Toastr::success('Parcel type deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.parcel-type.index');
    }
}
