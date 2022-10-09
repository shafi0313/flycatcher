<?php

namespace App\Http\Controllers;

use App\Http\Requests\BadDebtRequest;
use App\Models\BadDebt;
use App\Repository\Interfaces\BadDebtInterface;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreBadDebtRequest;
use App\Http\Requests\UpdateBadDebtRequest;

class BadDebtController extends Controller
{
    protected $badDebt;
    public function __construct(BadDebtInterface $badDebt)
    {
        $this->badDebt = $badDebt;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $badDebts = $this->badDebt->allBadDebtList(['added_by', 'modified_by'], '*', []);
            return DataTables::of($badDebts)
                ->addIndexColumn()
                ->addColumn('received_amount', function ($badDebt) {
                    return number_format($badDebt->amount - $badDebt->receivable_amount);
                })
                ->addColumn('action', function ($badDebt) {
                    return view('admin.bad-debt.action-button', compact('badDebt'));
                })
                ->tojson();
        }
        return view('admin.bad-debt.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bad-debt.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBadDebtRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BadDebtRequest $request)
    {
        $data = $request->validated();
        $data['receivable_amount'] = $request->amount;
        $data['created_by'] = Auth::guard('admin')->id();
        $this->badDebt->createBadDebt($data);
        return response()->successRedirect('New Bed Debt Added!', 'admin.bad-debts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BadDebt  $badDebt
     * @return \Illuminate\Http\Response
     */
    public function show(BadDebt $badDebt)
    {
        $badDebt =  $this->badDebt->findBadDebtDataById(['added_by', 'modified_by', 'bad_debt_adjusts.added_by'], '*', $badDebt->id);
        if (\request()->ajax()) {
            return DataTables::of($badDebt->bad_debt_adjusts)
                ->addIndexColumn()
                ->addColumn('amount', function ($adjustment) {
                    return number_format($adjustment->amount);
                })
                ->tojson();
        }
        return view('admin.bad-debt.show', compact('badDebt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BadDebt  $badDebt
     * @return \Illuminate\Http\Response
     */
    public function edit(BadDebt $badDebt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBadDebtRequest  $request
     * @param  \App\Models\BadDebt  $badDebt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBadDebtRequest $request, BadDebt $badDebt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BadDebt  $badDebt
     * @return \Illuminate\Http\Response
     */
    public function destroy(BadDebt $badDebt)
    {
        //
    }
}
