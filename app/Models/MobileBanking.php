<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileBanking extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable=[
        'merchant_id', 'rocket', 'bkash', 'nogod', 'status'
    ];

    protected $guarded = ['id'];

    protected $table = 'mobile_bankings';

}
