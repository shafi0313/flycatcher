<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Merchant;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
use App\services\ExpenseReportService;

class ExpenseReportController extends Controller
{
    public function view()
    {
        $data['expense_heads'] = ExpenseHead::all();
        return view('admin.report.expense.view', $data);
    }

    public function search(Request $request)
    {
        if (\request()->ajax()) {
            $dateRange = explode('to', \request()->date_range);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";
            $query = Expense::with(['hub', 'created_admin', 'updated_admin', 'expense_head'])->whereBetween('created_at', [$startDate, $endDate])
                ->when($request->expense_head_id != '0', function ($query) use ($request) {
                    return $query->where(['expense_head_id' => $request->expense_head_id]);
                }, function ($query) {
                    return $query;
                });
            $data['expenses'] = $query->latest()->get();
            //$data['expenses'] = Expense::with(['hub', 'created_admin', 'updated_admin', 'expense_head'])->whereBetween('created_at', [$startDate, $endDate])->latest()->get();
            // $data['expense_total'] = Expense::select(['id', 'amount'])->whereBetween('created_at', [$startDate, $endDate])->sum('amount');
            $data['expense_total'] = Expense::select(['id', 'amount'])->whereBetween('created_at', [$startDate, $endDate])
                ->when($request->expense_head_id != '0', function ($query) use ($request) {
                    return $query->where(['expense_head_id' => $request->expense_head_id])->sum('amount');
                }, function ($query) {
                    return $query->sum('amount');
                });

            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['expense_head_id'] = $request->expense_head_id;
            return response()->view('admin.report.expense.search-result', $data);
        }
    }

    public function print(Request $request)
    {
        $query = Expense::with(['hub', 'created_admin', 'updated_admin', 'expense_head'])->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->when($request->expense_head_id != '0', function ($query) use ($request) {
                return $query->where(['expense_head_id' => $request->expense_head_id]);
            }, function ($query) {
                return $query;
            });
        $data['expenses'] = $query->latest()->get();

        $data['expense_total'] = Expense::select(['id', 'amount'])->whereBetween('created_at', [$request->start_date, $request->end_date])
            ->when($request->expense_head_id != '0', function ($query) use ($request) {
                return $query->where(['expense_head_id' => $request->expense_head_id])->sum('amount');
            }, function ($query) {
                return $query->sum('amount');
            });

        // Expense::select(['id', 'amount'])->whereBetween('created_at', [$request->start_date, $request->end_date])->sum('amount');
        // $data['expenses'] = Expense::with(['hub', 'created_admin', 'updated_admin', 'expense_head'])->whereBetween('created_at', [$request->start_date, $request->end_date])->latest()->get();
        // $data['expense_total'] = Expense::select(['id', 'amount'])->whereBetween('created_at', [$request->start_date, $request->end_date])->sum('amount');
        $pdf = PDF::loadView(
            'admin.report.expense.pdf',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
            ]
        );
        $name = 'Expense List-' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
    }
    public function viewMonthly()
    {
        $data['expense_heads'] = ExpenseHead::all();
        return view('admin.report.expense-monthly.show', $data);
    }

    public function searchMonthly(Request $request, ExpenseReportService $service)
    {
        if (\request()->ajax()) {
            $days =  cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
            $expenseHeads =  ExpenseHead::select(['id', 'title'])->get();
            $amountData = $service->getAmountData($expenseHeads, $days, $request->month, $request->year);
            $totalAmounts = $service->getDailyAmountTotal($days, $request->month, $request->year);
            $data['days'] = $days;
            $data['month'] = $request->month;
            $data['year'] = $request->year;
            $data['deliveryChargeData'] = $amountData;
            $data['totalAmounts'] = $totalAmounts;
            return response()->view('admin.report.expense-monthly.search-result', $data);
        }
    }

    public function printMonthly(Request $request, ExpenseReportService $service)
    {
        $expenseHeads =  ExpenseHead::select(['id', 'title'])->get();
        $deliveryChargeData = $service->getAmountData($expenseHeads, $request->days, $request->month, $request->year);
        $totalDeliveryCharge = $service->getDailyAmountTotal($request->days, $request->month, $request->year);

        $data['days'] = $request->days;
        $data['month'] = date('M', mktime(0, 0, 0, $request->month));
        $data['year'] = $request->year;
        $data['deliveryChargeData'] = $deliveryChargeData;
        $data['totalDeliveryCharges'] = $totalDeliveryCharge;

        $pdf = PDF::loadView(
            'admin.report.expense-monthly.pdf',
            $data,
            [],
            [
                'format' => 'A4-L',
                'orientation' => 'L',
            ]
        );
        $name = 'Monthly Expense Report -' . date("Y-m-d");
        return $pdf->stream($name . '.pdf');
    }
}
