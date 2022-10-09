<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReasonType extends Model
{
    protected $fillable = [
        'name', 'reason_type', 'status',
    ];
    protected $table = 'reason_types';
    use HasFactory;
}
