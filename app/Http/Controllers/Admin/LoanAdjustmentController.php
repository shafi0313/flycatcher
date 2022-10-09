<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoanAdjustmentRequest;
use App\Repository\Interfaces\LoanAdjustmentInterface;
use App\Repository\Interfaces\LoanInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanAdjustmentController extends Controller
{
    protected $loan;
    protected $loanAdjust;
    public function __construct(LoanInterface $loan, LoanAdjustmentInterface $adjustment)
    {
        $this->loan = $loan;
        $this->loanAdjust = $adjustment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LoanAdjustmentRequest $request)
    {
        $loan = $this->loan->findLoanDataById([], ['id', 'current_amount', 'amount'], $request->loan_id);
        $unpaidAmount = $loan->amount - $loan->current_amount;

        if($request->amount > $loan->amount || ($request->amount + $unpaidAmount)>$loan->amount){
            return response()->errorRedirect('Wrong Input. Please enter the correct amount', 'admin.loans.index');
        }
        else{
            try {
                DB::beginTransaction();
                $loanAdjustData = $request->validated();
                $loanAdjustData['created_by'] = auth('admin')->user()->id;
                $this->loanAdjust->createLoanAdjustment($loanAdjustData);
                $this->loan->updateLoan([
                    'current_amount'=>$loan->current_amount - $request->amount
                ], $loan);
                DB::commit();
                return response()->successRedirect('Loan Adjusted', 'admin.loans.index');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->errorRedirect($e->getMessage(), 'admin.loans.index');
            }
        }
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
        //
    }
}
