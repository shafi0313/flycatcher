<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreInvestmentRequest;
use App\Http\Requests\UpdateInvestmentRequest;

class InvestmentController extends Controller
{
    public function index()
    {
        $investments = Investment::with('added_by', 'modified_by')->get();
        if (\request()->ajax()) {
            return DataTables::of($investments)
                ->addIndexColumn()
                ->addColumn('action', function ($investment) {
                    return view('admin.investment.action-button', compact('investment'));
                })
                ->tojson();
        }
        return view('admin.investment.index');
    }

    public function create()
    {
        return view('admin.investment.create');
    }

    public function store(StoreInvestmentRequest $request)
    {
        $validatedData = $request->validated();
        Investment::Create([
            'title' =>  $request->title,
            'amount' => $request->amount,
            'created_by' => Auth::guard('admin')->id()
        ]);
        Toastr::success('Investment Info Created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.investments.index');
    }

    public function show(Investment $investment)
    {
        return view('admin.investment.show', compact('investment'));
    }

    public function edit(Investment $investment)
    {
        $data = [
            'investment' => $investment,
        ];
        return view('admin.investment.edit', $data);
    }

    public function update(UpdateInvestmentRequest $request, Investment $investment)
    {
        $investment->fill($request->all());
        $investment->updated_by = Auth::guard('admin')->id();
        $investment->save();
        Toastr::success('Investment info Updated successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.investments.index');
    }

    public function destroy(Investment $investment)
    {
        $investment->delete();
        Toastr::success('Investment info created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.investments.index');
    }
}
