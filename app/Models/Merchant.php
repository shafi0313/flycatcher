<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Merchant extends Authenticatable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'area_id',
        'prefix',
        'name',
        'email',
        'mobile',
        'facebook_page',
        'website_url',
        'password',
        'company_name',
        'address',
        'isActive',
        'isSend',
        'isReturnCharge',
        'status',
        'created_by',
        'hub_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    protected $dateRange = request()->date_range;
       // explode('-', $request->date_range);
//$startDate = \date('Y-m-d', strtotime($dateRange[0]));
//$endDate = date('Y-m-d', strtotime($dateRange[1]));

    public function area(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id', 'id');
    }

    public function pickup_method(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MerchantPickupMethod::class);
    }

    public function payment_method(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MerchantPaymentMethod::class);
    }

    public function bank_account(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(MerchantBankAccount::class);
    }

    public function merchant_active_mobile_bankings(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MerchantMobileBanking::class)->where('status', 'active');
    }

    public function delivery_charges(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(DeliveryCharge::class);
    }
    public function collections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collection::class, 'merchant_id', 'id');
    }
    public function parcels(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Parcel::class);
    }
    public function admin(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }
}
