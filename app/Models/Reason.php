<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reason extends Model
{
    use HasFactory;

    protected $fillable = ['reasonable_id', 'reasonable_type', 'reason_type_id', 'other_reason', 'type'];

    protected $guarded = ['id'];

    protected $table = 'reasons';

    /**
     * Get the parent imageable model (user or post).
     */
    public function reasonable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function reason_type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ReasonType::class, 'reason_type_id', 'id');
    }
}
