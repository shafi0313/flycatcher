<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\WeightRangeRequest;
use App\Repository\Interfaces\WeightRangeInterface;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;

class WeightRangeController extends Controller
{
    protected $weightRangeRepo;
    protected $locationRepo;
    public function __construct(WeightRangeInterface $weightRange)
    {
        $this->weightRangeRepo = $weightRange;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weights = $this->weightRangeRepo->allLeastestWeight();
        if (\request()->ajax()) {
            return DataTables::of($weights)
                ->addIndexColumn()
                ->addColumn('status', function ($weight) {
                    return showStatus($weight->status);
                })
                ->addColumn('range', function ($weight) {
                    return $weight->min_weight. ' to '. $weight->max_weight;
                })
                ->addColumn('action', function ($weight) {
                    return view('admin.weight-range.action-button', compact('weight'));
                })
                ->rawColumns(['status', 'action'])
                ->tojson();
        }
        return view('admin.weight-range.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.weight-range.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(WeightRangeRequest $request)
    {
        $this->weightRangeRepo->createWeight($request->all());
        Toastr::success('Weight range created Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.weight-range.index');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['weightRange'] = $this->weightRangeRepo->getAnInstance($id);

        return view('admin.weight-range.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(WeightRangeRequest $request, $id)
    {

        $this->weightRangeRepo->updateWeight($request->all(), $id);
        Toastr::success('Weight range updated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.weight-range.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->weightRangeRepo->deleteWeight($id);
        Toastr::success('Weight range deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.weight-range.index');
    }
}
