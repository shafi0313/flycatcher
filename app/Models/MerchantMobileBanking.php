<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantMobileBanking extends Model
{
    use HasFactory;

    protected $fillable = [
        'merchant_id','mobile_banking_id','mobile_number', 'status'
    ];

    public function mobile_banking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MobileBanking::class, 'mobile_banking_id', 'id');
    }
    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MobileBanking::class, 'merchant_id', 'id');
    }
}
