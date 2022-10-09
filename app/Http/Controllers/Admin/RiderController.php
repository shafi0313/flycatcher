<?php

namespace App\Http\Controllers\Admin;

use App\Models\Area;
use PHPUnit\Exception;
use App\Models\SubArea;
use Illuminate\View\View;
use App\Models\AssignArea;
use App\Models\Admin\Rider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\services\RiderService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\RiderRequest;
use App\Repository\Interfaces\HubInterface;
use App\Repository\Interfaces\AreaInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Repository\Interfaces\RiderInterface;
use App\Repository\Interfaces\SubAreaInterface;
use App\Repository\Interfaces\AssignAreaInterface;

class RiderController extends Controller
{
    protected $areaRepo;
    protected $hubRepo;
    protected $riderRepo;
    protected $assignAreaRepo;
    protected $subAreaRepo;

    public function __construct(RiderInterface $riderInterface, HubInterface $hubInterface, AreaInterface $areaInterface, AssignAreaInterface $assignArea, SubAreaInterface $subArea)
    {
        $this->hubRepo = $hubInterface;
        $this->areaRepo = $areaInterface;
        $this->riderRepo = $riderInterface;
        $this->assignAreaRepo = $assignArea;
        $this->subAreaRepo = $subArea;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Exception
     */
    public function index()
    {
        if (\request()->ajax()) {
            $riders = $this->riderRepo->getLatestRider();
            return DataTables::of($riders)
                ->addIndexColumn()
                ->addColumn('rider_info', function ($rider) {
                    return '<b>Name: </b>' . $rider->name .
                        '<br><b>ID NO: </b>' . $rider->rider_code .
                        '<br><b>Mobile: </b>' . $rider->mobile .
                        '<br><b>Email: </b>' . $rider->email .
                        '<br><b>NID No: </b>' . $rider->nid;
                })
                ->addColumn('salary_info', function ($rider) {
                    if ($rider->salary_type === 'fixed')
                        return '<b>Type: </b>' . ucfirst($rider->salary_type);
                    else
                        return '<b>Type: </b>' . ucfirst($rider->salary_type) .
                            '<br><b>Commision: </b>' . $rider->commission_rate;
                })
                ->addColumn('address_info', function ($rider) {
                    return '<b>Present Address: </b>' . $rider->present_address .
                        '<br><b>Pemanent Address: </b>' . $rider->permanent_address;
                })
                ->addColumn('area_info', function ($rider) {
                    if (isset($rider->assign_areas)) {
                        $data = [
                            'rider' => $rider,
                            'assignAreas' => $rider->assign_areas,
                        ];
                        return \view('admin.rider.area-info', $data);
                    } else {
                        return '<span class="text-danger">Area not set</span>';
                    }
                })
                ->addColumn('status', function ($rider) {
                    return showStatus($rider->status);
                })
                ->addColumn('action', function ($rider) {
                    return view('admin.rider.action-button', compact('rider'));
                })
                ->rawColumns(['rider_info', 'salary_info', 'address_info', 'area_info', 'status', 'action'])
                ->tojson();
        }
        return view('admin.rider.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(RiderService $riderService)
    {
        $data['hubs'] = $this->hubRepo->getHubList();
        $data['areas'] = $this->areaRepo->allAreaList();
        $subAreas = $this->subAreaRepo->getAllSubArea();
        $assignAreas = $this->assignAreaRepo->getMultipleInstance(['assignable_type' => Rider::class]);

        $restArea = $riderService->getNonAssignSubAreaList($subAreas, $assignAreas);
//        $sub=[];
//        foreach ($subAreas as $subArea){
//            array_push($sub,$subArea->id);
//        }
//
//        $assign=[];
//        foreach ($assignAreas as $assignArea){
//            array_push($assign,$assignArea->sub_area_id);
//        }
//        $collection = collect($sub);
//        $diff = $collection->diff($assign);
//
//        $final = [];
//
//        foreach ($diff as $d){
//           array_push($final, $d);
//        }

        //$data['finalAreas'] = SubArea::whereIn('id', $restArea)->get();
        $data['finalAreas'] = $this->subAreaRepo->getInstancesByWhereIn('id', $restArea);

        return view('admin.rider.create', $data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param RiderRequest $request
     * @return Response
     */
    public function store(RiderRequest $request)
    {

        $data = $request->validated();
        $data['rider_code'] = 'PSRI-' . mt_rand(111111, 999999);
        $data['password'] = bcrypt('12345678');

        try {
            DB::beginTransaction();
            $rider = $this->riderRepo->createRider($data);
            foreach ($request->sub_area_id as $subAreaID) {
                $this->assignAreaRepo->createAssignArea([
                    'sub_area_id' => $subAreaID,
                    'assignable_id' => $rider->id,
                    'assignable_type' => Rider::class,
                ]);
            }
            DB::commit();
            return response()->successRedirect('Rider Created Successfully!.', 'admin.rider.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->errorRedirect($e->getMessage(), 'rider.parcel.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function show($id)
    {
        $data['rider'] = $this->riderRepo->getAnInstance($id);
        return view('admin.rider.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(Rider $rider, RiderService $riderService)
    {
        $rider = Rider::with(['assign_areas', 'assign_areas.sub_area', 'hub'])->findOrFail($rider->id);
        $riderAssignAreaArray = [];
        foreach ($rider->assign_areas as $subArea) {
            array_push($riderAssignAreaArray, $subArea->sub_area->id);
        }

        $subAreas = $this->subAreaRepo->getAllSubArea();


        $assignAreas = $this->assignAreaRepo->getMultipleInstance(['assignable_type' => Rider::class]);


        $restAreaID = $riderService->getNonAssignSubAreaList($subAreas, $assignAreas);


        $riderSubAreaIds = [];
        foreach ($rider->assign_areas as $assign_area) {
            $riderSubAreaIds[] = $assign_area->sub_area_id;
        }

        $riderAssignSubAreaList = SubArea::whereIn('id', $riderSubAreaIds)->pluck('id');


        $totalArea = [];

        foreach ($riderAssignSubAreaList as $list) {
            array_push($totalArea, $list);
        }

        foreach ($restAreaID as $id) {
            array_push($totalArea, $id);
        }

        $totalEditAbleArea = SubArea::whereIn('id', $totalArea)->pluck('name', 'id');


        $data =
            [
                'hubs' => $this->hubRepo->getHubList(),
                'areas' => $this->areaRepo->allAreaList(),
                //'finalAreaList' => $areaListWithoutAssign->concat($riderAssignSubAreaList),
                // 'riderSubAreaIds'=>$riderSubAreaIds,
                'rider' => $rider,
                'totalEditAbleArea' => $totalEditAbleArea,
                'riderSubAreaIds' => $riderSubAreaIds,

            ];
        return view('admin.rider.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RiderRequest $request
     * @param Rider $rider
     * @return Response
     */
    public function update(RiderRequest $request, Rider $rider)
    {
        //return $rider;
        try {
            DB::beginTransaction();
            $data = $request->except('sub_area_id');
            $data['status'] = $request->status;
            if ($request->has('sub_area_id')) {
                $this->assignAreaRepo->deleteAssignArea(['assignable_id' => $rider->id, 'assignable_type' => Rider::class]);
                foreach ($request->sub_area_id as $subAreaID) {
                    $this->assignAreaRepo->createAssignArea([
                        'sub_area_id' => $subAreaID,
                        'assignable_id' => $rider->id,
                        'assignable_type' => Rider::class,
                    ]);
                }
            }else{
                $this->assignAreaRepo->deleteAssignArea(['assignable_id' => $rider->id, 'assignable_type' => Rider::class]);
            }

            $this->riderRepo->updateRider($data, $rider);
            DB::commit();
            return response()->successRedirect('Rider Info Updated Successfully!.', 'admin.rider.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::info($exception->getMessage());
            return response()->errorRedirect($exception->getMessage(), 'admin.rider.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->riderRepo->deleteRider($id);
            return response()->successRedirect('Rider Info Deleted Successfully!.', 'admin.rider.index');
        } catch (\Exception $e) {
            return response()->errorRedirect($e->getMessage(), 'admin.rider.index');
        }
    }

    public function passwordReset($riderId)
    {
        $rider = $this->riderRepo->getAnInstance($riderId);
        $this->riderRepo->updateRider(['password' => bcrypt('12345678')], $rider);
        return response()->successRedirect('Password Reset', 'admin.rider.index');
    }

    public function login($riderId)
    {
        $data['rider'] = \auth('rider')->loginUsingId($riderId);
        session(['loggedIn-from-admin' => true]);
        return redirect()->route('rider.dashboard');
    }
}
