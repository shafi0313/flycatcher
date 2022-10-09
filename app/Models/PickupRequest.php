<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PickupRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'merchant_id',
        'assigned_by',
        'assigning_by',
        'service_type_id',
        'assigning_time',
        'picked_time',
        'cancel_time',
        'accepted_time',
        'status'
    ];
    public function merchant(){
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
    public function weight_range(){
        return $this->belongsTo(WeightRange::class, 'weight_range_id', 'id');
    }
    public function parcel_type()
    {
        return $this->belongsTo(ParcelType::class, 'parcel_type_id', 'id');
    }

    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'assigning_by', 'id');
    }
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'assigned_by', 'id');
    }
}
