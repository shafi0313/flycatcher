<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BadDebtAdjustRequest;
use App\Repository\Interfaces\BadDebtAdjustInterface;
use App\Repository\Interfaces\BadDebtInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BadDebtAdjustController extends Controller
{
    protected $adjust;
    protected $badDebt;

    public function __construct(BadDebtAdjustInterface $adjust, BadDebtInterface $badDebt)
    {
        $this->adjust = $adjust;
        $this->badDebt = $badDebt;
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
    public function store(BadDebtAdjustRequest $request)
    {
        $badDebt = $this->badDebt->findBadDebtDataById([], ['id', 'receivable_amount', 'amount'], $request->bad_debt_id);
        $receivedAmount = $badDebt->amount - $badDebt->receivable_amount;

        if($request->amount > $badDebt->amount || ($request->amount + $receivedAmount) > $badDebt->amount){
            return response()->errorRedirect('Wrong Input. Please enter the correct amount', 'admin.bad-debts.index');
        }
        else{
            try {
                DB::beginTransaction();
                $badDebtAdjustData = $request->validated();
                $badDebtAdjustData['created_by'] = auth('admin')->user()->id;
                $this->adjust->createBadDebtAdjust($badDebtAdjustData);
                $this->badDebt->updateBadDebt([
                    'receivable_amount'=>$badDebt->receivable_amount - $request->amount
                ], $badDebt);
                DB::commit();
                return response()->successRedirect('Bad Debts Adjusted', 'admin.bad-debts.index');
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->errorRedirect($e->getMessage(), 'admin.bad-debts.index');
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
