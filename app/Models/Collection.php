<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'collection_amount',
        'delivery_charge',
        'cod_charge',
        'net_payable',
        'cancle_amount',
        'parcel_id',
        'merchant_id',
        'rider_collected_by',
        'rider_collected_time',
        'rider_collected_status',
        'rider_transfer_request_time',
        'incharge_collected_by',
        'incharge_collected_time',
        'incharge_transfer_request_time',
        'incharge_collected_status',
        'accounts_collected_by',
        'accounts_collected_time',
        'accounts_collected_status',
        'merchant_paid',
        'note',
        'rider_collection_transfer_for',
        'incharge_collection_transfer_for'
    ];

    protected $table = 'collections';

    public function parcel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'parcel_id', 'id');
    }

    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'rider_collected_by', 'id');
    }

    public function rider_transfer_for(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'rider_collection_transfer_for', 'id');
    }

    public function incharge(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'incharge_collected_by', 'id');
    }
    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function accountant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'accounts_collected_by', 'id');
    }

}
