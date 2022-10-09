<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParcelsExport;
use App\Models\Area;
use App\Models\Merchant;

class CustomerExportController extends Controller
{
    public function index()
    {
        $merchants = Merchant::pluck('name', 'id');
        $select_merchants = Merchant::pluck('id');
        $areas = Area::all();
        return view('admin.customer-export.create', compact('areas', 'merchants','select_merchants'));
    }
    public function export(Request $request)
    {
        // dd($request->all());
        // $daterange = request()->input('daterange');
        $dateRange = explode('-', request()->input('daterange'));
        $startDate = (date("Y-m-d", strtotime($dateRange[0])));
        $endDate = (date("Y-m-d", strtotime($dateRange[1])));
        $merchant_id = request()->input('merchant_id');
        $area_id = request()->input('area_id');
        return Excel::download(new ParcelsExport($merchant_id, $area_id, $startDate,$endDate), 'customers.xlsx');
    }
}
