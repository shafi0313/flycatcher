<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParcelTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'parcel_id',
        'transfer_by',
        'transfer_for',
        'transfer_sub_area',
        'status',
        'accept_time',
        'reject_time',
        'accept_or_reject_by'
    ];

    public function parcel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'parcel_id', 'id');
    }

    public function sub_area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubArea::class, 'transfer_sub_area', 'id');
    }

    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'transfer_for', 'id');
    }

    public function present_rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'transfer_by', 'id');
    }

    public function accept_reject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'accept_or_reject_by', 'id');
    }
}
