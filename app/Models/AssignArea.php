<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignArea extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'sub_area_id',
        'assignable_id',
        'assignable_type'
    ];

    protected $table = 'assign_areas';
    /**
     * Get the parent assignable model (rider or hub or agent).
     */

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function sub_area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubArea::class, 'sub_area_id', 'id');
    }
    public function assignable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
}
