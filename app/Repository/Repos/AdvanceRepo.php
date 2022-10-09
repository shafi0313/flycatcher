<?php

namespace App\Repository\Repos;

use App\Models\Advance;
use App\Repository\Interfaces\AdvanceInterface;
use Illuminate\Support\Facades\DB;

class AdvanceRepo implements AdvanceInterface
{
    public function allAdvanceList()
    {
        return Advance::with(['admin' => function ($q) {
            $q->select(['id', 'name']);
        }, 'rider' => function ($q) {
            $q->select(['id', 'name']);
        }])
            ->select(['id',
                DB::raw('SUM(advance) AS  total_advance_for_specific_user'),
                DB::raw('SUM(adjust) AS total_adjust_for_specific_user'),
                DB::raw('SUM(advance) - SUM(adjust) AS total_receivable_for_specific_user'),
                'created_for_admin', 'created_for_rider', 'guard_name'
            ])
            ->groupBy('created_for_admin')
            ->groupBy('created_for_rider')
            ->havingRaw('(SUM(advance)+SUM(adjust)+SUM(advance))>0')
            ->orderByRaw('(guard_name) asc')
            ->latest();
    }

    public function getAnInstance($advanceId)
    {
        return Advance::findOrFail($advanceId);
    }

    public function createAdvance($data)
    {
        return Advance::create($data);
    }

    public function updateAdvance($requestData, $advanceData)
    {
        return $advanceData->update($requestData);
    }

    public function deleteAdvance($advanceId)
    {
        $advance = $this->getAnInstance($advanceId);
        return $advance->delete();
    }
}
