<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubArea extends Model
{
    use HasFactory;

    protected $fillable = ['area_id', 'name', 'code', 'status'];

    protected $table = 'sub_areas';

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function assign_sub_area(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(AssignArea::class);
    }
}
