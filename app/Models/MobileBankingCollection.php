<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MobileBankingCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'parcel_id', 'mobile_banking_id', 'merchant_mobile_banking_id', 'customer_mobile_number'
    ];

    public function mobile_banking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MobileBanking::class, 'mobile_banking_id', 'id');
    }

    public function merchant_mobile_banking(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(MerchantMobileBanking::class, 'merchant_mobile_banking_id', 'id');
    }
}
