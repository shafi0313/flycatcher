<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiderCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'parcel_id', 'rider_id', 'note'
    ];

    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'rider_id', 'id');
    }

    public function parcel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'rider_id', 'id');
    }
}
