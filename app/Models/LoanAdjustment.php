<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAdjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'amount',
        'note',
        'created_by',
        'updated_by'
    ];


    public function loan(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
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
