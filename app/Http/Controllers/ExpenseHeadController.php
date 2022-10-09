<?php

namespace App\Http\Controllers;

use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Yajra\DataTables\Facades\DataTables;
use App\Repository\Interfaces\ExpenseHeadInterface;

class ExpenseHeadController extends Controller
{
    protected $expenseHeadRepo;

    public function __construct(ExpenseHeadInterface $expenseHeadInterface)
    {
        $this->expenseHeadRepo = $expenseHeadInterface;
    } 
    public function index()
    {
        $expenseHeads = $this->expenseHeadRepo->allLatestExpenseHead();
        if (\request()->ajax()) {
            return DataTables::of($expenseHeads)
                ->addIndexColumn()
                ->addColumn('status', function ($expenseHead) {
                    return showStatus($expenseHead->status);
                })
                ->addColumn('action', function ($expenseHead) {
                    return view('admin.expense-head.action-button', compact('expenseHead'));
                })
                ->rawColumns(['status', 'action'])
                ->tojson();
        }
        return view('admin.expense-head.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expense-head.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->expenseHeadRepo->createExpenseHead([
            'title'=>$request->title,
        ]);
        Toastr::success('expense Head info created successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.expense-head.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseHead $expenseHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseHead $expenseHead)
    {
        $data['expenseHead'] = $this->expenseHeadRepo->getAnInstance($expenseHead->id);
        return view('admin.expense-head.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseHead $expenseHead)
    {
        $data = [
            'title'=>$request->title,
            'status'=>$request->status,
        ];
        $this->expenseHeadRepo->updateExpenseHead($data, $expenseHead->id);
        Toastr::success('updated successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.expense-head.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseHead $expenseHead)
    {
        $this->expenseHeadRepo->deleteExpenseHead($expenseHead->id);
        Toastr::success('Expense Head deleted Successfully!.', '', ["progressBar" => true]);
        return redirect()->route('admin.expense-head.index');
    }
}
