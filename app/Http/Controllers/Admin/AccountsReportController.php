<?php

namespace App\Http\Controllers\Admin;

use App\Models\BadDebt;
use App\Models\Loan;
use App\Models\Advance;
use App\Models\Expense;
use App\Models\Collection;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use PDF;

class AccountsReportController extends Controller
{
    public function balanceSheet()
    {
        $data['totalDeliveryCharge'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('delivery_charge');
        $data['totalLoan'] = Loan::sum('amount');
        $data['totalExpense'] = Expense::sum('amount');
        $totalAdvance = Advance::sum('advance');
        $totalAdjust = Advance::sum('adjust');
        $data['totalInvestment'] = Investment::sum('amount');
        $data['totalAdvance'] = $totalAdvance - $totalAdjust;
        return view('admin.balance-sheet.show', $data);
    }
    public function cashSummary()
    {
        $data['totalCollection'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('amount');
        $data['totalDeliveryCharge'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('delivery_charge');
        $data['totalcancleAmount'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('cancle_amount');
        $data['merchant_payable'] = Collection::where(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'])->sum('net_payable');
        $data['merchant_paid'] = Collection::where(['accounts_collected_status' => 'collected'])->whereIn('merchant_paid', ['paid', 'received'])->sum('net_payable');
        $data['expense'] = Expense::sum('amount');
        $totalAdvance = Advance::sum('advance');
        $totalAdjust = Advance::sum('adjust');
        $data['advance'] = $totalAdvance - $totalAdjust;
        $data['loan'] = Loan::sum('current_amount');
        $data['badDebt'] = BadDebt::sum('receivable_amount');
        return view('admin.accounts.show', $data);
    }
    public function cashSummaryPrint()
    {
       
        $data['totalCollection'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('amount');
        $data['totalDeliveryCharge'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('delivery_charge');
        $data['totalcancleAmount'] = Collection::where(['accounts_collected_status' => 'collected'])->sum('cancle_amount');
        $data['merchant_payable'] = Collection::where(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'])->sum('net_payable');
        $data['merchant_paid'] = Collection::where(['accounts_collected_status' => 'collected'])->whereIn('merchant_paid', ['paid', 'received'])->sum('net_payable');
        $data['expense'] = Expense::sum('amount');
        $totalAdvance = Advance::sum('advance');
        $totalAdjust = Advance::sum('adjust');
        $data['advance'] = $totalAdvance - $totalAdjust;
        $data['loan'] = Loan::sum('current_amount');
        $data['badDebt'] = BadDebt::sum('receivable_amount');
        $pdf = PDF::loadView(
            'admin.accounts.pdf',
            $data,
            [],
            [
                'format' => 'A4-P',
                'orientation' => 'P',
            ]
        );
        $name = 'Cash Summary';
        return $pdf->stream($name . '.pdf');
    }

    public function searchResult()
    {
        if (\request()->ajax()) {
            $dateRange = explode('to', \request()->date_range);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";

            $data['collectionBeforeSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '<', $startDate)->sum('amount');
            $data['collectionBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('amount');

            $data['merchantPaidBeforeSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereIn('merchant_paid', ['paid', 'received'])->whereDate('merchant_paid_time', '<', $startDate)->sum('net_payable');
            $data['merchantPaidBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereIn('merchant_paid', ['paid', 'received'])->whereBetween('merchant_paid_time', [$startDate, $endDate])->sum('net_payable');

            $data['merchantPayableBeforeSearch'] = Collection::where(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'])->whereDate('accounts_collected_time', '<', $startDate)->sum('net_payable');
            $data['merchantPayableBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('net_payable');

            $data['deliveryChargeBeforeSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '<', $startDate)->sum('delivery_charge');
            $data['deliveryChargeBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('delivery_charge');

            $data['codChargeBeforeSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '<', $startDate)->sum('cod_charge');
            $data['codChargeBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('cod_charge');

            $data['expenseBeforeSearch'] = Expense::whereDate('created_at', '<', $startDate)->sum('amount');
            $data['expenseBetweenSearch'] = Expense::whereBetween('created_at', [$startDate, $endDate])->sum('amount');

            $data['advanceBeforeSearch'] = Advance::whereDate('created_at', '<', $startDate)->sum('advance') - Advance::whereDate('created_at', '<', $startDate)->sum('adjust');
            $data['advanceBetweenSearch'] = Advance::whereBetween('created_at', [$startDate, $endDate])->sum('advance') - Advance::whereBetween('created_at', [$startDate, $endDate])->sum('adjust');

            $data['loanBeforeSearch'] = Loan::whereDate('created_at', '<', $startDate)->sum('current_amount');
            $data['loanBetweenSearch'] = Loan::whereBetween('created_at', [$startDate, $endDate])->sum('current_amount');

            $data['badDebtBeforeSearch'] = BadDebt::whereDate('created_at', '<', $startDate)->sum('receivable_amount');
            $data['badDebtBetweenSearch'] = BadDebt::whereBetween('created_at', [$startDate, $endDate])->sum('receivable_amount');;

            $data['searchBeforeClosingBalanceWithoutMerchantPayable'] = ($data['deliveryChargeBeforeSearch'] + $data['codChargeBeforeSearch'] + $data['loanBeforeSearch']) - ($data['expenseBeforeSearch'] + $data['advanceBeforeSearch'] + $data['badDebtBeforeSearch']);
            $data['searchBeforeClosingBalanceWithMerchantPayable'] = ($data['merchantPayableBeforeSearch'] + $data['deliveryChargeBeforeSearch'] + $data['codChargeBeforeSearch'] + $data['loanBeforeSearch']) - ($data['expenseBeforeSearch'] + $data['advanceBeforeSearch'] + $data['badDebtBeforeSearch']);

            $data['searchBeforeClosingBalance'] = ($data['merchantPayableBeforeSearch'] + $data['deliveryChargeBeforeSearch'] + $data['codChargeBeforeSearch'] + $data['loanBeforeSearch']) - ($data['expenseBeforeSearch'] + $data['advanceBeforeSearch'] + $data['badDebtBeforeSearch']);
            $data['searchBetweenClosingBalance'] = $data['searchBeforeClosingBalance'] + ($data['merchantPayableBetweenSearch'] + $data['deliveryChargeBetweenSearch'] + $data['codChargeBetweenSearch'] + $data['loanBetweenSearch']) - ($data['expenseBetweenSearch'] + $data['advanceBetweenSearch'] + $data['badDebtBetweenSearch']);

           $data['collectionBetweenSearch'] = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('amount');

           $openingDeliveryCharge = Collection::where(['accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '<', $startDate)->sum('delivery_charge');
           $openingCODCharge = Collection::where(['accounts_collected_status' => 'collected'])->whereDate('accounts_collected_time', '<', $startDate)->sum('cod_charge');

           $openingExpense = Expense::whereDate('created_at', '<', $startDate)->sum('amount');

           $openingAdvance = Advance::whereDate('created_at', '<', $startDate)->sum('advance');
           $openingAdjust = Advance::whereDate('created_at', '<', $startDate)->sum('adjust');


           $searchDeliveryCharge = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('delivery_charge');
           $searchCodCharge = Collection::where(['accounts_collected_status' => 'collected'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('cod_charge');
           $searchPayableForMerchant = Collection::where(['accounts_collected_status' => 'collected', 'merchant_paid'=>'unpaid'])->whereBetween('accounts_collected_time', [$startDate, $endDate])->sum('net_payable');
           $searchExpense = Expense::whereBetween('created_at', [$startDate, $endDate])->sum('amount');

           $searchAdvance = Advance::whereBetween('created_at', [$startDate, $endDate])->sum('advance');
           $searchAdjust = Advance::whereBetween('created_at', [$startDate, $endDate])->sum('adjust');

           $closingBalance = ($openingDeliveryCharge + $openingCODCharge) - ($openingExpense + ($openingAdvance - $openingAdjust));

           $searchBalance = ($searchDeliveryCharge + $searchCodCharge) - ($searchExpense + ($searchAdvance - $searchAdjust));

           $previousLoan = Loan::whereDate('created_at', '<', $startDate)->sum('current_amount');
           $data['searchLoan'] = Loan::whereBetween('created_at', [$startDate, $endDate])->sum('current_amount');

           $previousBadDebt = BadDebt::whereDate('created_at', '<', $startDate)->sum('receivable_amount');
           $data['searchBadDebt'] = BadDebt::whereBetween('created_at', [$startDate, $endDate])->sum('receivable_amount');

           $data['closingBalance'] = ($closingBalance + $previousLoan) - $previousBadDebt;

           $data['searchPayableForMerchant'] = $searchPayableForMerchant;
           $data['searchDeliveryCharge'] = $searchDeliveryCharge;
           $data['searchCodCharge'] = $searchCodCharge;
           $data['searchExpense'] = $searchExpense;
           $data['searchAdvance'] = $searchAdvance - $searchAdjust;

           $data['searchBalance'] = $searchBalance;

           $data['cashInHand'] = $closingBalance + $searchBalance;

            //return view('admin.accounts.search-result');
            return response()->view('admin.accounts.search-result', $data);
        }
    }
}
