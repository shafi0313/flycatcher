<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Advance;
use App\Models\Hub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class AdvanceReportController extends Controller
{
    public function view()
    {
        $data['hubs'] = Hub::all();
        return view('admin.report.advance.view', $data);
    }

    public function search(Request $request)
    {
        if (\request()->ajax()) {
            $dateRange = explode('to', \request()->date_range);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";

            $data['advances'] = Advance::with(['hub','admin' => function ($q) {
                $q->select(['id', 'name']);
            }, 'rider' => function ($q) {
                $q->select(['id', 'name']);
            }])
                ->select(['id', 'hub_id',
                    DB::raw('SUM(advance) AS  total_advance_for_specific_user'),
                    DB::raw('SUM(adjust) AS total_adjust_for_specific_user'),
                    DB::raw('SUM(advance) - SUM(adjust) AS total_receivable_for_specific_user'),
                    'created_for_admin', 'created_for_rider', 'guard_name'
                ])

                ->when(\request()->hub_id == '0', function ($query){
                     return $query;
                }, function ($query){
                     return $query->where(['hub_id'=>1]);
                })
                ->groupBy('created_for_admin')
                ->groupBy('created_for_rider')
                ->havingRaw('(SUM(advance)+SUM(adjust)+SUM(advance))>0')
                ->orderByRaw('(guard_name) asc')
                ->whereBetween('advances.created_at', [$startDate, $endDate])
                ->latest()->get();




//            $data['adminCollections'] = DB::table('advances')
//                ->join('admins', 'advances.created_for_admin', '=', 'admins.id')
//                ->groupBy('advances.created_for_admin')
//                ->select('advances.*', DB::raw('SUM(advance) as totalAdvance'), DB::raw('SUM(adjust) as totalAdjust'), DB::raw('SUM(advance) - SUM(adjust) as totalReceivable'), 'admins.id as admin_id', 'admins.name as admin_name')
//                ->whereBetween('advances.created_at', [$startDate, $endDate])
//                ->get();
//            $data['riderCollections'] = DB::table('advances')
//                ->join('riders', 'advances.created_for_rider', '=', 'riders.id')
//                ->groupBy('advances.created_for_rider')
//                ->select('advances.*', DB::raw('SUM(advance) as totalAdvance'), DB::raw('SUM(adjust) as totalAdjust'), DB::raw('SUM(advance) - SUM(adjust) as totalReceivable'), 'riders.id as rider_id', 'riders.name as rider_name')
//                ->whereBetween('advances.created_at', [$startDate, $endDate])
//                ->get();
            $data['startDate'] = $startDate;
            $data['endDate'] = $endDate;
            $data['hub_id'] = \request()->hub_id;
            return response()->view('admin.report.advance.search-result', $data);
        }
    }

    public function print(Request $request){
//        $data['adminCollections'] = DB::table('advances')
//            ->join('admins', 'advances.created_for_admin', '=', 'admins.id')
//            ->groupBy('advances.created_for_admin')
//            ->select('advances.*', DB::raw('SUM(advance) as totalAdvance'), DB::raw('SUM(adjust) as totalAdjust'), DB::raw('SUM(advance) - SUM(adjust) as totalReceivable'), 'admins.id as admin_id', 'admins.name as admin_name')
//            ->whereBetween('advances.created_at', [$request->start_date, $request->end_date])
//            ->get();
//        $data['riderCollections'] = DB::table('advances')
//            ->join('riders', 'advances.created_for_rider', '=', 'riders.id')
//            ->groupBy('advances.created_for_rider')
//            ->select('advances.*', DB::raw('SUM(advance) as totalAdvance'), DB::raw('SUM(adjust) as totalAdjust'), DB::raw('SUM(advance) - SUM(adjust) as totalReceivable'), 'riders.id as rider_id', 'riders.name as rider_name')
//            ->whereBetween('advances.created_at', [$request->start_date, $request->end_date])
//            ->get();
        $data['advances'] = Advance::with(['hub','admin' => function ($q) {
            $q->select(['id', 'name']);
        }, 'rider' => function ($q) {
            $q->select(['id', 'name']);
        }])
            ->select(['id', 'hub_id',
                DB::raw('SUM(advance) AS  total_advance_for_specific_user'),
                DB::raw('SUM(adjust) AS total_adjust_for_specific_user'),
                DB::raw('SUM(advance) - SUM(adjust) AS total_receivable_for_specific_user'),
                'created_for_admin', 'created_for_rider', 'guard_name'
            ])

            ->when(\request()->hub_id == '0', function ($query){
                return $query;
            }, function ($query){
                return $query->where(['hub_id'=>1]);
            })
            ->groupBy('created_for_admin')
            ->groupBy('created_for_rider')
            ->havingRaw('(SUM(advance)+SUM(adjust)+SUM(advance))>0')
            ->orderByRaw('(guard_name) asc')
            ->whereBetween('advances.created_at', [$request->start_date, $request->end_date])
            ->latest()->get();
        $pdf = PDF::loadView(
            'admin.report.advance.pdf',
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
}
