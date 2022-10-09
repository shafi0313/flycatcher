<?php

namespace App\Models;

use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'advance','total_advance','adjust', 'total_adjust', 'note', 'hub_id', 'created_for_admin','created_for_rider', 'updated_by', 'created_by', 'guard_name', 'status', 'receivable',
    ];

    public function hub(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_for_admin', 'id');
    }

    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'created_for_rider', 'id');
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


