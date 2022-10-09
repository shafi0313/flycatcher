<?php

namespace App\Imports;

use App\Models\Area;
use App\Models\Parcel;
use App\Models\SubArea;
use App\Models\WeightRange;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParcelsImportForm implements ToModel, WithHeadingRow
{
  
    public function model(array $row)
    {
        
    }
}
