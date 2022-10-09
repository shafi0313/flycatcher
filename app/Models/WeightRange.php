<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeightRange extends Model
{
    use HasFactory;
    protected $fillable =['min_weight', 'max_weight', 'code', 'status'];
    protected $guarded = ['id'];
    protected $table ='weight_ranges';
}
