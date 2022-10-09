<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{

    protected $fillable=[
        'name','district_id'
    ];
    public function district(){

        return $this->belongsTo('App\Models\District', 'district_id');

    }
}
