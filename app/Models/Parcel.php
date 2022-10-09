<?php

namespace App\Models;

use App\Models\Otp;
use App\Models\Collection;
use App\Models\Admin\Rider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Parcel extends Model
{
    use HasFactory;

    protected $fillable = [
        'hub_id',
        'city_type_id',
        'area_id',
        'sub_area_id',
        'merchant_id',
        'weight_range_id',
        'parcel_type_id',
        'payment_status',
        'payment_type',
        'tracking_id',
        'invoice_id',
        'note',
        'assigned_by',
        'assigning_by',
        'customer_name',
        'customer_address',
        'customer_mobile',
        'customer_another_mobile',
        'collection_amount',
        'delivery_charge',
        'cod',
        'cod_percentage',
        'payable',
        'guard_name',
        'added_by_admin',
        'added_by_merchant',
        'return_product',
        'is_transfer',
        'added_date',
        'status',
        'delivery_status',
        'cancle_partial_invoice'
    ];

    protected $table = 'parcels';

    public function cityType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CityType::class, 'city_type_id', 'id');
    }
    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }
    public function sub_area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubArea::class, 'sub_area_id', 'id');
    }
    public function merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'merchant_id', 'id');
    }
    public function weightRange(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(WeightRange::class, 'weight_range_id', 'id');
    }
    public function parcelType(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(ParcelType::class, 'parcel_type_id', 'id');
    }
    public function rider(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rider::class, 'assigning_by', 'id');
    }

    public function created_by_admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'added_by_admin', 'id');
    }

    public function created_by_merchant(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Merchant::class, 'added_by_merchant', 'id');
    }

    public function reason(): \Illuminate\Database\Eloquent\Relations\MorphOne
    {
        return $this->morphOne(Reason::class, 'reasonable');
    }
    public function parcelCollection(){
        return $this->hasOne(Collection::class);
    }

    public function times(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ParcelTime::class, 'parcel_id');
    }
    public function lastActivity()
    {
        return ParcelTime::where('parcel_id', $this->id)->orderBy('time', 'desc')->first();
    }

    public function mobile_banking_collection(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MobileBankingCollection::class);
    }

    public function collection(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Collection::class, 'parcel_id', 'id');
    }
    public function otp(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Otp::class, 'parcel_id', 'id');
    }

    public function invoice_item(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(InvoiceItem::class);
    }

    public function parcel_transfers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ParcelTransfer::class)->latest();
    }

    public function notes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ParcelNote::class, 'parcel_id', 'id');
    }

    public function getTotalCollectionAmountAttribute(){
        if(! empty($request->date_range)){
            $dateRange = explode('to', \request()->date_range);
            $startDate = "$dateRange[0] 00:00:00";
            $endDate = "$dateRange[1] 23:59:59";
            $this->collection()->where(['parcel.merchant_id' => \request()->merchant_id])->whereBetween('parcel.created_at', [$startDate, $endDate])->sum('collection.amount');
        }else{
            $this->collection()->where(['parcel.merchant_id' => \request()->merchant_id])->sum('collection.amount');
        }
//        if(! empty($request->date_range) , function ($query) use ($request) {
//            $dateRange = explode('to', \request()->date_range);
//            $startDate = "$dateRange[0] 00:00:00";
//            $endDate = "$dateRange[1] 23:59:59";
//            return $query->where(['merchant_id' => $request->merchant_id])->whereBetween('created_at', [$startDate, $endDate]);
//        }, function ($query) use ($request){
//            return $query->where(['merchant_id' => $request->merchant_id]);
//
//        });
//        $this->collection()->where(['rider_collected_status'=>'collected'])->first();
    }

}
