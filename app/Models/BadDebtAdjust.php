<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadDebtAdjust extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount', 'note', 'bad_debt_id', 'created_by', 'updated_by'
    ];

    public function bad_debt(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(BadDebt::class, 'bad_debt_id', 'id');
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

