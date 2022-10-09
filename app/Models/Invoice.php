<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'hub_id','invoice_id', 'invoice_type', 'invoice_number', 'total_collection_amount','total_cod','total_delivery_charge','date','note','prepare_for_id', 'prepare_for_type', 'status','payment_method'
    ];

    public function invoice(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function prepare_for(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }
    public function invoiceItems(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(InvoiceItem::class);
    }

    public function getInvoiceDetailsItemAttribute(){
        return $this->invoiceItems()->with(['parcel', 'parcel.collection'])->latest();
    }
    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
}
