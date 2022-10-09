<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'amount',
        'note',
        'current_amount',
        'created_by',
        'updated_by'
    ];

    public function loan_adjustments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(LoanAdjustment::class, 'loan_id', 'id')->latest();
    }

    public function added_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public function modified_by(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'updated_by', 'id');
    }
}
