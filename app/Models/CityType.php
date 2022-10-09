<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityType extends Model
{
    use HasFactory;

    protected $fillable =['name', 'status'];
    protected $guarded = ['id'];
    protected $table = 'city_types';

    public function areas(){
        return $this->hasMany(Area::class, 'city_type_id', 'id');
    }
}
