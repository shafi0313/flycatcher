<?php

namespace App\Models\Admin;

use App\Models\Advance;
use App\Models\Area;
use App\Models\AssignArea;
use App\Models\Collection;
use App\Models\Hub;
use App\Models\Parcel;
use App\Models\ParcelTime;
use App\Models\RiderCollection;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Rider extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    protected $fillable = [
        'hub_id',
        'area_id',
        'name',
        'rider_code',
        'email',
        'mobile',
        'present_address',
        'permanent_address',
        'nid',
        'avatar',
        'salary_type',
        'commission_type',
        'commission_rate',
        'status',
        'password',
    ];

    protected $guarded = ['id'];

    protected $table = 'riders';
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function hub(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function assign_areas(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(AssignArea::class, 'assignable');
    }

//    public function rider_assign_sub_areas(){
//        return $this->morphMany(AssignArea::class, 'assignable')->where(['assignable_type'=>Rider::class]);
//    }

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function rider_collections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(RiderCollection::class);
    }

    public function collections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collection::class, 'rider_collected_by', 'id');
    }

    public function parcels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Parcel::class, 'assigning_by');
    }

    public function getTotalParcelsAttribute()
    {
        $dateRange = explode('-', request()->date_range);
        $startDate = \date('Y-m-d', strtotime($dateRange[0]));
        $endDate = \date('Y-m-d', strtotime($dateRange[1]));
        return [
            'total' => $this->parcels()->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'pending' => $this->parcels()->where(['status' => 'pending'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'transit' => $this->parcels()->where(['status' => 'transit'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'delivered' => $this->parcels()->where(['status' => 'delivered'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'partial' => $this->parcels()->where(['status' => 'partial'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'hold' => $this->parcels()->where(['status' => 'hold'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
            'cancelled' => $this->parcels()->where(['status' => 'cancelled'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count()
                + $this->parcels()->where(['status' => 'cancel_accept_by_incharge'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count() +
                +$this->parcels()->where(['status' => 'cancel_accept_by_merchant'])->whereBetween('added_date', [$startDate . " 00:00:00", $endDate . " 23:59:59"])->count(),
        ];
    }

    public function times(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(ParcelTime::class, Parcel::class, 'assigned_by', 'parcel_id');
    }

    public function getParcelStatusCountAttribute(){
        return [
          'transit'=>$this->times()->where(['time_type'=>'transit'])->whereDate('time', Carbon::today())->count(),
          'hold'=>$this->times()->where(['time_type'=>'hold'])->whereDate('time', Carbon::today())->count(),
        ];
    }

    public function advances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advance::class, 'created_for_rider', 'id');
    }

    public function scopeTotalAdvance(){
        return $this->advances()->sum('advance');
    }

    public function scopeTotalAdjust(): string
    {
        return $this->advances()->sum('adjust');
    }

    public function getTotalCollectedAmountAttribute(){
        return $this->collections()->sum('amount');
    }
    public function getTotalCollectedDeliveryChargeAttribute(){
        return $this->collections()->sum('delivery_charge');
    }
    public function getTotalCollectedCodChargeAttribute(){
        return $this->collections()->sum('cod_charge');
    }

    public function getTotalPaidAmountAttribute(){
        return $this->collections()->where(['rider_collected_status'=>'transferred'])->sum('amount');
    }
    public function getTotalPaidDeliveryChargeAttribute(){
        return $this->collections()->where(['rider_collected_status'=>'transferred'])->sum('delivery_charge');
    }
    public function getTotalPaidCodChargeAttribute(){
        return $this->collections()->where(['rider_collected_status'=>'transferred'])->sum('cod_charge');
    }

    public function getTotalUnpaidAmountAttribute(){
        return $this->collections()->whereIn('rider_collected_status',['collected', 'transfer_request'])->sum('amount');
    }
    public function getTotalUnpaidDeliveryChargeAttribute(){
        return $this->collections()->whereIn('rider_collected_status',['collected', 'transfer_request'])->sum('delivery_charge');
    }
    public function getTotalUnpaidCodChargeAttribute(){
        return $this->collections()->whereIn('rider_collected_status',['collected', 'transfer_request'])->sum('cod_charge');
    }

}
