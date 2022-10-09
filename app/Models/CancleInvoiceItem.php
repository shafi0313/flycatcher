<?php

namespace App\Models;

use App\Models\Parcel;
use App\Models\Collection;
use App\Models\CancleInvoice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CancleInvoiceItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function invoice(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CancleInvoice::class, 'cancle_invoice_id', 'id');
    }

    public function parcel(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Parcel::class, 'parcel_id', 'id');
    }
    public function collection(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Collection::class, 'parcel_id', 'parcel_id');
    }
}
