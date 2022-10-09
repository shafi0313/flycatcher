<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchantBankAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'merchant_id','bank_id','branch_name','routing_number','account_name','account_number', 'status',
    ];

    protected $guarded = ['id'];

    protected $table = 'merchant_bank_accounts';

    public function bank(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Bank::class, 'bank_id', 'id');
    }
}
