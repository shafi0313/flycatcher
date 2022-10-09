<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParcelType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'status'];
    protected $guarded = ['id'];
    protected $table= 'parcel_types';
}
