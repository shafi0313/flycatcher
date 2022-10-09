<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Admin\Rider;
use App\Models\Advance;
use App\Repository\Interfaces\AdminInterface;
use App\Repository\Interfaces\RiderInterface;
use App\services\AdvanceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\AdvanceRequest;
use App\Repository\Interfaces\AdvanceInterface;

class AdvanceController extends Controller
{
    protected $advanceRepo;
    protected $adminRepo;
    protected $riderRepo;

    public function __construct(AdvanceInterface $advances, AdminInterface $admin, RiderInterface $rider)
    {
        $this->advanceRepo = $advances;
        $this->adminRepo = $admin;
        $this->riderRepo = $rider;
    }

    public function index(AdvanceService $service)
    {
        $data['admins'] =  $this->adminRepo->allAdminList(['advances'], ['id', 'name'], ['isActive'=>1]);
        $data['riders'] =  $this->riderRepo->allRiderList();
        $data['advanceData'] = $service->countAdvanceAndAdjust();

        return view('admin.advance.index', $data);
    }

    public function admin(AdvanceService $service)
    {
        if (\request()->ajax()) {
            $admins = $this->adminRepo->allAdminList(['advances'], ['id', 'name'], ['isActive' => 1]);
            return $service->advanceDataTable($admins, 'admin');
        }
        return view('admin.advance.index');
    }

    public function rider(AdvanceService $service)
    {
        if (\request()->ajax()) {
            $riders = $this->riderRepo->allRiderList();
            return $service->advanceDataTable($riders, 'rider');
        }
        return view('admin.advance.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['admins'] = $this->adminRepo->allAdminList([], ['id', 'name'], ['isActive' => '1']);
        $data['riders'] = $this->riderRepo->allRiderList();
        return view('admin.advance.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdvanceRequest $request)
    {
        //return $request->all();
        $data = $request->validated();

        if (is_null($request->created_for_admin)) {
            $data['guard_name'] = 'rider';
            $advance = Advance::where(['created_for_rider' => $request->created_for_rider])->latest()->first();
            if (isset($advance)) {
                $data['total_advance'] = $advance->total_advance + $request->advance;
                $data['receivable'] = $advance->receivable + $request->advance;
            } else {
                $data['total_advance'] = $request->advance;
                $data['receivable'] = $request->advance;
            }
            $data['hub_id'] = Rider::select('hub_id')->findOrFail($request->created_for_rider)->hub_id;
        } elseif (is_null($request->created_for_rider)) {
            $data['guard_name'] = 'admin';
            $advance = Advance::where(['created_for_admin' => $request->created_for_admin])->latest()->first();
            if (isset($advance)) {
                $data['total_advance'] = $advance->total_advance + $request->advance;
                $data['receivable'] = $advance->receivable + $request->advance;
            } else {
                $data['total_advance'] = $request->advance;
                $data['receivable'] = $request->advance;
            }
            $data['hub_id'] = Admin::select('hub_id')->findOrFail($request->created_for_admin)->hub_id;
        }
        $data['created_by'] = auth('admin')->user()->id;
        $this->advanceRepo->createAdvance($data);
        return response()->successRedirect('Advance created successfully', 'admin.advance.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Advance $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Advance $advance
     * @return \Illuminate\Http\Response
     */
    public function edit(Advance $advance)
    {
        $data['advance'] = $advance;
        return view('admin.advance.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Advance $advance
     * @return \Illuminate\Http\Response
     */
    public function update(AdvanceRequest $request, Advance $advance)
    {

        $data = $request->validated();
        $data['updated_by'] = auth('admin')->user()->id;
        $this->advanceRepo->updateAdvance($data, $advance);
        return response()->successRedirect('Updated successfully', 'admin.advance.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Advance $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Advance $advance)
    {
        //
    }

    public function adjust(Request $request)
    {

        $request->validate([
            'created_for_rider' => 'sometimes|numeric',
            'created_for_admin' => 'sometimes|numeric',
            'advance_total' => 'required|numeric',
            'receivable' => 'required|numeric',
            'adjust' => 'required|numeric|lte:receivable',
        ]);

        if ($request->has('created_for_admin')) {
            $data['guard_name'] = 'admin';
            $data['hub_id'] = Admin::select('hub_id')->findOrFail($request->created_for_admin)->hub_id;
            $data['created_for_admin'] = $request->created_for_admin;
            $advance = Advance::where(['created_for_admin' => $request->created_for_admin])->latest()->first();
            if (isset($advance)) {
                $data['adjust'] = $request->adjust;
                $data['total_adjust'] = $advance->total_adjust + $request->adjust;
                $data['receivable'] = $request->advance_total - ($advance->total_adjust + $request->adjust);
            }
        } elseif ($request->has('created_for_rider')) {
            $data['guard_name'] = 'rider';
            $data['hub_id'] = Rider::select('hub_id')->findOrFail($request->created_for_rider)->hub_id;
            $data['created_for_rider'] = $request->created_for_rider;
            $advance = Advance::where(['created_for_rider' => $request->created_for_rider])->latest()->first();
            if (isset($advance)) {
                $data['adjust'] = $request->adjust;
                $data['total_adjust'] = $advance->total_adjust + $request->adjust;
                $data['receivable'] = $request->advance_total - ($advance->total_adjust + $request->adjust);
            }
        }
        $data['created_by'] = auth('admin')->user()->id;
        $this->advanceRepo->createAdvance($data);
        return response()->successRedirect('Advance created successfully', 'admin.advance.index');
    }

    public function print(AdvanceService $service)
    {
        $data['advanceData'] = $service->countAdvanceAndAdjust();
        $data['admins'] = $this->adminRepo->allAdminList(['advances'], ['id', 'name'], ['isActive' => 1]);
        $data['riders'] = $this->riderRepo->allRiderList();
        $pdf = PDF::loadView(
            'admin.advance.pdf',
            $data,
            [],
            [
                'format' => 'A4-p',
                'orientation' => 'p',
            ]
        );
        $name = 'Advance List-' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
    }
}
