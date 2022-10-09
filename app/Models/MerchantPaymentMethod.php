<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPaymentMethod extends Model
{
    use HasFactory;
    protected $fillable = [
        'merchant_id', 'payment_method_id', 'withdraw_type', 'status'
    ];

    protected $guarded = [
        'id'
    ];

    protected $table = 'merchant_payment_methods';
}
