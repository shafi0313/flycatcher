<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadDebt extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'amount',
        'receivable_amount',
        'note',
        'created_by',
        'updated_by'
    ];
    public function added_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public function modified_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'id');
    }

    public function bad_debt_adjusts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(BadDebtAdjust::class, 'bad_debt_id', 'id')->latest();
    }
}
