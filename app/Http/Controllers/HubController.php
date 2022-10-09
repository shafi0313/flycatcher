<?php

namespace App\Http\Controllers;

use App\Http\Requests\HubRequest;
use App\Models\Hub;
use App\Models\Area;
use App\Repository\Interfaces\AreaInterface;
use App\Repository\Interfaces\HubInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;

class HubController extends Controller
{
    protected $hubRepo;
    protected $areaRepo;

    public function __construct(HubInterface $hubInterface, AreaInterface $areaInteface)
    {
        $this->hubRepo = $hubInterface;
        $this->areaRepo = $areaInteface;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $hubs = $this->hubRepo->allLatestHub();
        if (\request()->ajax()) {
            return DataTables::of($hubs)
                ->addIndexColumn()
                ->addColumn('area', function ($hub) {
                    if (isset($hub->area)) {
                        return $hub->area->area_name . ' (' . $hub->area->area_code . ')';
                    } else {
                        return '<div class="text-danger">Not Set</div>';
                    }
                })
                ->addColumn('status', function ($hub) {
                    return showStatus($hub->status);
                })
                ->addColumn('action', function ($hub) {
                    return view('admin.hub.action-button', compact('hub'));
                })
                ->rawColumns(['status','area', 'action'])
                ->tojson();
        }
        return view('admin.hub.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data = [
            'model' => new Hub(),
            'areas' => $this->areaRepo->allAreaList(),
        ];

        return view('admin.hub.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(HubRequest $request)
    {
       $this->hubRepo->hubCreate($request->all());
       Toastr::success('Hub Created Successfully!.', '', ["progressBar" => true]);
       return redirect()->route('admin.hub.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Hub $hub
     * @return Response
     */
    public function show(Hub $hub)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Hub $hub
     * @return Response
     */
    public function edit(Hub $hub)
    {
        $data = [
            'model' => $hub,
            'areas' => $this->areaRepo->allAreaList(),
        ];
        return view('admin.hub.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param HubRequest $request
     * @param Hub $hub
     * @return RedirectResponse
     */
    public function update(HubRequest $request, Hub $hub): RedirectResponse
    {
        $this->hubRepo->updateHub($request->all(), $hub);
        Toastr::success('Hub Updated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.hub.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Hub $hub
     * @return Response
     */
    public function destroy(Hub $hub)
    {
        $this->hubRepo->deleteHub($hub);
        Toastr::success('Hub Deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->back();
    }
}
