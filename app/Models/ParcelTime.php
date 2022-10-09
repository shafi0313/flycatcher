<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_id', 'time_type', 'time'
    ];

    public function parcel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'parcel_id', 'id');
    }
}
