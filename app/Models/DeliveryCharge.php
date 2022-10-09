<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliveryCharge extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['city_type_id', 'weight_range_id', 'delivery_charge', 'cod', 'status', 'merchant_id', 'is_global'];

    protected $table = 'delivery_charges';

    public function merchant(){
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }

    public function cityType(){
        return $this->belongsTo(CityType::class, 'city_type_id', 'id');
    }

    public function weightRange(){
        return $this->belongsTo(WeightRange::class, 'weight_range_id', 'id');
    }
}
