<?php

namespace App\Exports;

use App\Models\Parcel;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ParcelsExport implements FromView
{
    protected $merchant_id;
    protected $area_id;
    protected $startDate;
    protected $endDate;
    public function  __construct($merchant_id, $area_id, $startDate, $endDate)
    {
        $this->merchant_id = $merchant_id;
        $this->area_id = $area_id;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function view(): View
    {
        if (!empty($this->startDate) && !empty($this->endDate)) {
            if (!empty($this->merchant_id) && is_null($this->area_id)) {
                $parcels = Parcel::whereIn('merchant_id', $this->merchant_id)->whereBetween('added_date', [$this->startDate, $this->endDate])->get();
            } else if (is_null($this->merchant_id) && !empty($this->area_id)) {
                $parcels = Parcel::where('area_id', $this->area_id)->whereBetween('added_date', [$this->startDate, $this->endDate])->get();
            } else if (is_null($this->merchant_id) && is_null($this->area_id)) {
                $parcels = Parcel::whereBetween('added_date', [$this->startDate, $this->endDate])->get();
            } else {
                $parcels = Parcel::whereIn('merchant_id', $this->merchant_id)->where('area_id', $this->area_id)->whereBetween('added_date', [$this->startDate, $this->endDate])->get();
            }
        }
        return view('admin.excel.exports.parcels', [
            // 'parcels' => Parcel::where('area_id', $this->area_id)->get()
            'parcels' => $parcels
        ]);
    }
}
