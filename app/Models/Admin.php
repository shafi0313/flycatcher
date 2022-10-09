<?php

namespace App\Models;

use App\Models\AdminInfo;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens,HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'hub_id',
        'mobile',
        'password',
        'isActive'
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

    public function hub(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Hub::class, 'hub_id', 'id');
    }

    public function expenses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Expense::class);
    }

    public function collections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collection::class, 'incharge_collected_by', 'id');
    }

//    public function rider_collection_transfer(){
//        return $this->hasMany(Collection::class, 'rider_collection_transfer_for', 'id');
//    }
    public static function getpermissionGroups()
    {
        $permission_groups = DB::table('permissions')
            ->select('group_name as name')
            ->groupBy('group_name')
            ->get();
        return $permission_groups;
    }

    public static function getpermissionsByGroupName($group_name)
    {
        $permissions = DB::table('permissions')
            ->select('name', 'id')
            ->where('group_name', $group_name)
            ->get();
        return $permissions;
    }

    public static function roleHasPermissions($role, $permissions)
    {
        $hasPermission = true;
        foreach ($permissions as $permission) {
            if (!$role->hasPermissionTo($permission->name)) {
                $hasPermission = false;
                return $hasPermission;
            }
        }
        return $hasPermission;
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Invoice::class, 'invoice');
    }

    public function rider_collection_transfer_for_incharge(){
        return $this->hasMany(Collection::class, 'rider_collection_transfer_for', 'id');
    }

    public function getInchargeWaitingForAcceptAttribute(){
        return $this->rider_collection_transfer_for_incharge()->where(['rider_collected_status'=>'transfer_request'])->whereNull('incharge_collected_by')->whereNull('incharge_collected_status')->sum('amount');
    }

    public function getInchargeCurrentBalanceAttribute(){
        return $this->collections()->where(['incharge_collected_status'=>'collected'])->sum('amount');
    }
    public function getInchargeRequestForTransferAttribute(){
        return $this->collections()->where(['incharge_collected_status'=>'transfer_request'])->sum('amount');
    }

    public function advances(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Advance::class, 'created_for_admin', 'id');
    }

    public function scopeTotalAdvance(): string
    {
        return $this->advances()->sum('advance');
    }

    public function scopeTotalAdjust(): string
    {
        return $this->advances()->sum('adjust');
    }

    public function getTotalCollectedAmountForInchargeAttribute(){
        return $this->collections()->sum('amount');
    }
    public function getTotalCollectedDeliveryChargeForInchargeAttribute(){
        return $this->collections()->sum('delivery_charge');
    }
    public function getTotalCollectedCodChargeForInchargeAttribute(){
        return $this->collections()->sum('cod_charge');
    }

    public function getTotalPaidAmountForInchargeAttribute(){
        return $this->collections()->where(['incharge_collected_status'=>'transferred'])->sum('amount');
    }
    public function getTotalPaidDeliveryChargeForInchargeAttribute(){
        return $this->collections()->where(['incharge_collected_status'=>'transferred'])->sum('delivery_charge');
    }
    public function getTotalPaidCodChargeForInchargeAttribute(){
        return $this->collections()->where(['incharge_collected_status'=>'transferred'])->sum('cod_charge');
    }

    public function getTotalUnpaidAmountForInchargeAttribute(){
        return $this->collections()->whereIn('incharge_collected_status',['collected', 'transfer_request'])->sum('amount');
    }
    public function getTotalUnpaidDeliveryChargeForInchargeAttribute(){
        return $this->collections()->whereIn('incharge_collected_status',['collected', 'transfer_request'])->sum('delivery_charge');
    }
    public function getTotalUnpaidCodChargeForInchargeAttribute(){
        return $this->collections()->whereIn('incharge_collected_status',['collected', 'transfer_request'])->sum('cod_charge');
    }

    public function accountant_collections(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Collection::class, 'accounts_collected_by', 'id');
    }


    public function getTotalCollectedAmountForAccountantAttribute(){
        return $this->accountant_collections()->sum('amount');
    }
    public function getTotalCollectedDeliveryChargeForAccountantAttribute(){
        return $this->accountant_collections()->sum('delivery_charge');
    }
    public function getTotalCollectedCodChargeForAccountantAttribute(){
        return $this->accountant_collections()->sum('cod_charge');
    }

    public function getTotalPaidAmountForAccountantAttribute(){
        return $this->accountant_collections()->whereIn('merchant_paid', ['paid', 'received'])->sum('amount');
    }
    public function getTotalPaidDeliveryChargeForAccountantAttribute(){
        return $this->accountant_collections()->whereIn('merchant_paid', ['paid', 'received'])->sum('delivery_charge');
    }
    public function getTotalPaidCodChargeForAccountantAttribute(){
        return $this->accountant_collections()->whereIn('merchant_paid', ['paid', 'received'])->sum('cod_charge');
    }

    public function getTotalUnpaidAmountForAccountantAttribute(){
        return $this->accountant_collections()->where(['merchant_paid'=>'unpaid'])->sum('amount');
    }
    public function getTotalUnpaidDeliveryChargeForAccountantAttribute(){
        return $this->accountant_collections()->where(['merchant_paid'=>'unpaid'])->sum('delivery_charge');
    }
    public function getTotalUnpaidCodChargeForAccountantAttribute(){
        return $this->accountant_collections()->where(['merchant_paid'=>'unpaid'])->sum('cod_charge');
    }
}
