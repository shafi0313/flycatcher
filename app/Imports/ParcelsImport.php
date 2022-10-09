<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\WeightRange;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParcelsImport implements ToModel, WithHeadingRow
{
    protected $merchant_id;
    public function  __construct($merchant_id)
    {
        $this->merchant_id = $merchant_id;
    }

    public function model(array $row)
    {
        if(!is_null($row['area_code']) && !is_null($row['weight'])){
            $area = Area::where('area_code', $row['area_code'])->first();
            $subarea = SubArea::where('area_id', $area->id)->first();
            $WeightRange = WeightRange::where('min_weight', '<=', $row['weight'])->where('max_weight', '>=', $row['weight'])->first();
    
            return new Parcel([
                'invoice_id'          => $row['invoice_number'],
                'customer_name'       => $row['customer_name'],
                'customer_mobile'     => $row['customer_mobile'],
                'customer_address'    => $row['customer_address'],
                'area_id'             => $area->id,
                'sub_area_id'             => $subarea->id,
                'city_type_id'        => $area->city->id,
                'assigning_by'        => $area->rider->id,
                'assigned_by'         => Auth::guard('admin')->user()->id,
                'payment_status'      => 'unpaid',
                'weight_range_id'     => $WeightRange->id,
                'parcel_type_id'      => 1,
                'tracking_id'         => \App\Classes\TrackingNumber::serial_number(),
                'collection_amount'   => $row['collection_amount'],
                'delivery_charge'     => $row['delivery_charge'],
                'payable'             => $row['collection_amount'] - $row['delivery_charge'],
                'merchant_id'         => $this->merchant_id,
                'note'                => $row['note'],
            ]);
        }
    }
    public function rules(): array
    {
        return [
            'invoice_id' => 'required'
        ];
    }

    public function customValidationMessages()
    {
        return [
            'invoice_id.required' => 'Correo ya esta en uso.',
        ];
    }
}
