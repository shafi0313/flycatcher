<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    use HasFactory;
    protected $fillable=[
       'city_type_id', 'name', 'district_id', 'upazila_id', 'area_name', 'area_code', 'status'
    ];

    protected $guarded = ['id'];

    protected $table = 'areas';

    public function sub_areas(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SubArea::class);
    }
    public function rider(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Rider::class);
    }
    public function city_type(){
        return $this->belongsTo(CityType::class, 'city_type_id', 'id');
    }

    public function division(){
        return $this->belongsTo(Division::class, 'division_id', 'id');
    }
    public function district(){
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
    public function upazila(){
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id');
    }
    public function city(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CityType::class, 'city_type_id', 'id');
    }
}
