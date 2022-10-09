<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreComplaintRequest;
use App\Http\Requests\UpdateComplaintRequest;
use App\Repository\Interfaces\MerchantInterface;
use App\Repository\Interfaces\ComplaintInterface;

class ComplaintController extends Controller
{
    protected $complaintRepo;
    protected $merchantRepo;

    public function __construct(MerchantInterface $merchantInterface, ComplaintInterface $complaintInterface)
    {
        $this->merchantRepo = $merchantInterface;
        $this->complaintRepo = $complaintInterface;
    }
    public function index()
    {
        $complaints = $this->complaintRepo->allLatestComplaint();
        if (\request()->ajax()) {
            return DataTables::of($complaints)
                ->addIndexColumn()
                ->addColumn('status', function ($complaint) {
                    return showStatus($complaint->status);
                })
                ->addColumn('action', function ($complaint) {
                    return view('admin.complaint.action-button', compact('complaint'));
                })
                ->rawColumns(['status', 'action'])
                ->tojson();
        }
        return view('admin.complaint.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $merchants = $this->merchantRepo->allMerchantList();
        return view('admin.complaint.create', compact('merchants'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreComplaintRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreComplaintRequest $request)
    {
        $this->complaintRepo->createComplaint([
            'merchant_id' => $request->merchant_id,
            'description' => $request->description,
        ]);
        Toastr::success('Complaint info created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.complaints.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function edit(Complaint $complaint)
    {
        $data['complaint'] = $this->complaintRepo->getAnInstance($complaint->id);
        $data['merchants'] = $this->merchantRepo->allMerchantList();
        return view('admin.complaint.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateComplaintRequest  $request
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        $data = [
            'merchant_id' => $request->merchant_id,
            'description' => $request->description,
            'reply' => $request->reply,
            'status'=>$request->status,
        ];
        $this->complaintRepo->updateComplaint($data, $complaint->id);
        Toastr::success('Complaint Updated Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.complaints.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Complaint  $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        $this->complaintRepo->deleteComplaint($complaint->id);
        Toastr::success('Complaint deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.complaints.index');
    }
}
