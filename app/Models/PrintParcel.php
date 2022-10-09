<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintParcel extends Model
{
    use HasFactory;
    public function items()
    {
        return $this->hasMany('App\Models\PrintParcelItem', 'print_parcel_id');
    }
    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class);
    }
}
