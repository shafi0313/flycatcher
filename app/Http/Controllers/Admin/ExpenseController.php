<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Repository\Interfaces\ExpenseHeadInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\Admin\ExpenseRequest;
use App\Repository\Interfaces\ExpenseInterface;
use Illuminate\Http\Response;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    protected $expenseRepo;
    protected $expenseHeadRepo;

    public function __construct(ExpenseInterface $expenses, ExpenseHeadInterface $expenseHead)
    {
        $this->expenseRepo = $expenses;
        $this->expenseHeadRepo = $expenseHead;
    }

    public function index()
    {
        if (\request()->ajax()) {
            $expenses = $this->expenseRepo->getAllLatestExpense();
            return DataTables::of($expenses)
                ->addIndexColumn()
                ->addColumn('expense_title', function ($expense) {
                    return $expense->expense_head->title;
                })
                ->addColumn('create_update_by', function ($expense) {
                    if (isset($expense->updated_admin)) {
                        return '<b>Created By: </b>' . $expense->created_admin->name .
                            '<br><b>Updated By</b>:' . $expense->updated_admin->name;
                    } else {
                        return '<b>Created By: </b>' . $expense->created_admin->name .
                            '<br><b>Updated By</b>: ';
                    }

                })
                ->addColumn('create_update_date', function ($expense) {
                    return '<b>Created Time: </b>' . $expense->created_at .
                        '<br><b>Updated Time</b>:' . $expense->updated_at;
                })
                ->addColumn('action', function ($expense) {
                    return view('admin.expense.action-button', compact('expense'));
                })
                ->rawColumns(['status', 'create_update_by', 'create_update_date', 'action', 'expense_title'])
                ->tojson();
        }
        return view('admin.expense.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $data['expenseHeads'] = $this->expenseHeadRepo->allExpenseHeadList();
        return view('admin.expense.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(ExpenseRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = auth('admin')->user()->id;
        $this->expenseRepo->storeExpense($data);
        return response()->successRedirect('Expense Created Successfully', 'admin.expense.index');
    }

    /**
     * Display the specified resource.
     *
     * @param Expense $expense
     * @return Response
     */
    public function show(Expense $expense)
    {
        $data['expense'] = $this->expenseRepo->expenseDetailById($expense->id);
        return view('admin.expense.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Expense $expense
     * @return Response
     */
    public function edit(Expense $expense)
    {
        $data['expenseHeads'] = $this->expenseHeadRepo->allExpenseHeadList();
        $data['expense'] = $expense;
        return view('admin.expense.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ExpenseRequest $request
     * @param Expense $expense
     * @return Response
     */
    public function update(ExpenseRequest $request, Expense $expense)
    {
        $data = $request->validated();
        $data['updated_by'] = auth('admin')->user()->id;
        $data['updated_at'] = Carbon::now();
        try {
            $this->expenseRepo->updateExpense($data, $expense);
            return response()->successRedirect('Expense Updated Successfully', 'admin.expense.index');
        } catch (\Exception $e) {
            return response()->successRedirect($e->getMessage(), 'admin.expense.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Expense $expense
     * @return Response
     */
    public function destroy(Expense $expense)
    {
        $this->expenseRepo->deleteExpense($expense);
        return response()->successRedirect('Expense Deleted Successfully', 'admin.expense.index');
    }

    public function print(){
        $data['expenses'] = $this->expenseRepo->getAllLatestExpense()->get();
        $pdf = PDF::loadView(
            'admin.expense.print',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Delivery Report -' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');

    }
}
