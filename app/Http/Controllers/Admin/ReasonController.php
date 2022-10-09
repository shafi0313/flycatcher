<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReasonTypeRequest;
use App\Models\ReasonType;
use App\Repository\Interfaces\ReasonInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ReasonController extends Controller
{
    protected $reasonRepo;
    public function __construct(ReasonInterface $reason)
    {
        $this->reasonRepo = $reason;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = $this->reasonRepo->getAllReasonType();
        if (\request()->ajax()) {
            return DataTables::of($reasons)
                ->addIndexColumn()
                ->addColumn('reason_type', function ($reason) {
                    switch ($reason->reason_type){
                        case 'hold':
                            return '<div class="badge badge-warning">Hold</div>';
                        case 'cancel':
                            return '<div class="badge badge-danger">Cancel</div>';
                        case 'both':
                            return '<div class="badge badge-secondary">Both</div>';
                    };
                })
                ->addColumn('status', function ($reason) {
                    return showStatus($reason->status);
                })
                ->addColumn('action', function ($reason) {
                    return view('admin.reason.action-button', compact('reason'));
                })
                ->rawColumns(['status', 'reason_type', 'action'])
                ->tojson();
        }
        return view('admin.reason.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.reason.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReasonTypeRequest $request)
    {
        $this->reasonRepo->createReasonType($request->validated());
        return response()->successRedirect('Info Added !','admin.reason.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reasonType = $this->reasonRepo->getAnReasonTypeInstance($id);
        $this->reasonRepo->deleteReasonType($reasonType);
        return response()->successRedirect('Info deleted !','admin.reason.index');
    }
}
