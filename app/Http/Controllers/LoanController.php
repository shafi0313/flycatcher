<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Loan;
use App\Repository\Interfaces\LoanInterface;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreLoanRequest;
use App\Http\Requests\UpdateLoanRequest;
use Yajra\DataTables\Facades\DataTables;

class LoanController extends Controller
{
    public $loan;
    public function __construct(LoanInterface $loan)
    {
        $this->loan = $loan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (\request()->ajax()) {
            $loans = $this->loan->allLoanList(['added_by', 'modified_by'], '*', []);
            return DataTables::of($loans)
                ->addIndexColumn()
                ->addColumn('paid_amount', function ($loan) {
                    return $loan->amount - $loan->current_amount;
                })
                ->addColumn('action', function ($loan) {
                    return view('admin.loan.action-button', compact('loan'));
                })
                ->tojson();
        }
        return view('admin.loan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.loan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreLoanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanRequest $request)
    {
        $data = $request->validated();
        $data['current_amount'] = $request->amount;
        $data['created_by'] = Auth::guard('admin')->id();

        $this->loan->createLoan($data);
        return response()->successRedirect('New Loan Added!', 'admin.loans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
        $loan = $this->loan->findLoanDataById(['added_by', 'modified_by', 'loan_adjustments.added_by'], '*', $loan->id);
        if (\request()->ajax()) {
            return DataTables::of($loan->loan_adjustments)
                ->addIndexColumn()
                ->addColumn('amount', function ($adjustment) {
                    return number_format($adjustment->amount);
                })
                ->addColumn('action', function ($loan) {
                    return view('admin.loan.action-button', compact('loan'));
                })
                ->tojson();
        }
        return view('admin.loan.show',compact('loan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        $data = [
            'loan' => $loan,
        ];
        return view('admin.loan.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateLoanRequest  $request
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Loan $loan)
    {
        $loan->fill($request->all());
        $loan->updated_by = Auth::guard('admin')->id();
        $loan->save();
        Toastr::success('Loan info Updated successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.loans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        $loan->delete();
        Toastr::success('Loan info created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.loans.index');
    }
}
