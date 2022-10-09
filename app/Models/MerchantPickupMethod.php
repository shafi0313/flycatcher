<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPickupMethod extends Model
{
    use HasFactory;

    protected $fillable = ['hub_id', 'merchant_id', 'pickup_type'];

    protected $guarded = ['id'];

    protected $table= 'merchant_pickup_methods';

    public function merchant(){
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function hub(){
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

}
