<?php

namespace App\services;

use App\Models\Advance;
use Yajra\DataTables\Facades\DataTables;

class AdvanceService
{
//    public function advanceQuery(){
//
//    }
    public function advanceDataTable($userInfos, $type)
    {
        return DataTables::of($userInfos)
            ->addIndexColumn()
            ->addColumn('advance', function ($userInfo) {
                return number_format($userInfo->TotalAdvance());
            })
            ->addColumn('adjust', function ($userInfo) {
                return number_format($userInfo->TotalAdjust());
            })
            ->addColumn('receivable', function ($userInfo) {
                return number_format($userInfo->TotalAdvance() - $userInfo->TotalAdjust());
            })
            ->addColumn('action', function ($userInfo) use($type){
                return view('admin.advance.action-button', compact('userInfo', 'type'));
            })
            ->addColumn('totalAdvances', function ($userInfo) {
                return Advance::where(['guard_name' => 'admin'])->sum('advance');
            })
            ->addColumn('totalAdjust', function ($userInfo) {
                return Advance::where(['guard_name' => 'admin'])->sum('adjust');
            })
            ->rawColumns(['advance', 'adjust', 'receivable', 'action', 'totalAdvances'])
            ->tojson();
    }

    public function countAdvanceAndAdjust()
    {
        return [
            'totalAdvance' => Advance::select(['id', 'advance'])->sum('advance'),
            'totalAdjust' => Advance::select(['id', 'adjust'])->sum('adjust'),

            'totalAdvanceForAdmin' => Advance::where(['guard_name' => 'admin'])->sum('advance'),
            'totalAdjustForAdmin' => Advance::where(['guard_name' => 'admin'])->sum('adjust'),

            'totalAdvanceForRider' => Advance::where(['guard_name' => 'rider'])->sum('advance'),
            'totalAdjustForRider' => Advance::where(['guard_name' => 'rider'])->sum('adjust'),
        ];
    }
}
