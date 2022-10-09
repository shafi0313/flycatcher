<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class AccessControlsTableSeeder extends Seeder
{


    public function run()
    {

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $dev = \App\Models\Admin::where('email', 'super@gmail.com')->first();

        if (empty($dev)) {

            $data = [
                [
                    'id' => '1',
                    'hub_id' => 1,
                    'name' => 'Super Admin',
                    'email' => 'super@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id' => '2',
                    'hub_id' => 1,
                    'name' => 'Admin',
                    'email' => 'admin@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id' => '3',
                    'hub_id' => 1,
                    'name' => 'Accounts',
                    'email' => 'accounts@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id' => '4',
                    'hub_id' => 1,
                    'name' => 'Incharge',
                    'email' => 'incharge@gmail.com',
                    'password' => bcrypt('12345678'),
                ],
                [
                    'id' => '5',
                    'hub_id' => 1,
                    'name' => 'Merketing',
                    'email' => 'merketing@gmail.com',
                    'password' => bcrypt('12345678'),
                ]

            ];

            DB::table('admins')->insert($data);
        }



        $dev = \App\Models\Admin::where('email', 'super@gmail.com')->first();

        //data for roles table
        $data = [
            ['name' => 'Super Admin', 'guard_name' => 'admin'],
            ['name' => 'Admin', 'guard_name' => 'admin'],
            ['name' => 'Accounts', 'guard_name' => 'admin'],
            ['name' => 'Incharge', 'guard_name' => 'admin'],
            ['name' => 'Marketing', 'guard_name' => 'admin'],
        ];
        DB::table('roles')->insert($data);

        //data for permissions table
        $data = [
            ['name' => 'dashboard', 'guard_name' => 'admin', 'group_name' => 'dashboard'],

            ['name' => 'admin-list', 'guard_name' => 'admin', 'group_name' => 'admin'],
            ['name' => 'admin-create', 'guard_name' => 'admin', 'group_name' => 'admin'],
            ['name' => 'admin-show', 'guard_name' => 'admin', 'group_name' => 'admin'],
            ['name' => 'admin-edit', 'guard_name' => 'admin', 'group_name' => 'admin'],
            ['name' => 'admin-delete', 'guard_name' => 'admin', 'group_name' => 'admin'],

            ['name' => 'role-list', 'guard_name' => 'admin', 'group_name' => 'role'],
            ['name' => 'role-create', 'guard_name' => 'admin', 'group_name' => 'role'],
            ['name' => 'role-show', 'guard_name' => 'admin', 'group_name' => 'role'],
            ['name' => 'role-edit', 'guard_name' => 'admin', 'group_name' => 'role'],
            ['name' => 'role-delete', 'guard_name' => 'admin', 'group_name' => 'role'],

            ['name' => 'permission-list', 'guard_name' => 'admin', 'group_name' => 'permission'],
            ['name' => 'permission-create', 'guard_name' => 'admin', 'group_name' => 'permission'],
            ['name' => 'permission-show', 'guard_name' => 'admin', 'group_name' => 'permission'],
            ['name' => 'permission-edit', 'guard_name' => 'admin', 'group_name' => 'permission'],
            ['name' => 'permission-delete', 'guard_name' => 'admin', 'group_name' => 'permission'],

            ['name' => 'hub-list', 'guard_name' => 'admin', 'group_name' => 'hub'],
            ['name' => 'hub-create', 'guard_name' => 'admin', 'group_name' => 'hub'],
            ['name' => 'hub-show', 'guard_name' => 'admin', 'group_name' => 'hub'],
            ['name' => 'hub-edit', 'guard_name' => 'admin', 'group_name' => 'hub'],
            ['name' => 'hub-delete', 'guard_name' => 'admin', 'group_name' => 'hub'],

            ['name' => 'division-list', 'guard_name' => 'admin', 'group_name' => 'division'],
            ['name' => 'division-create', 'guard_name' => 'admin', 'group_name' => 'division'],
            ['name' => 'division-show', 'guard_name' => 'admin', 'group_name' => 'division'],
            ['name' => 'division-edit', 'guard_name' => 'admin', 'group_name' => 'division'],
            ['name' => 'division-delete', 'guard_name' => 'admin', 'group_name' => 'division'],

            ['name' => 'district-list', 'guard_name' => 'admin', 'group_name' => 'district'],
            ['name' => 'district-create', 'guard_name' => 'admin', 'group_name' => 'district'],
            ['name' => 'district-show', 'guard_name' => 'admin', 'group_name' => 'district'],
            ['name' => 'district-edit', 'guard_name' => 'admin', 'group_name' => 'district'],
            ['name' => 'district-delete', 'guard_name' => 'admin', 'group_name' => 'district'],

            ['name' => 'upazila-list', 'guard_name' => 'admin', 'group_name' => 'upazila'],
            ['name' => 'upazila-create', 'guard_name' => 'admin', 'group_name' => 'upazila'],
            ['name' => 'upazila-show', 'guard_name' => 'admin', 'group_name' => 'upazila'],
            ['name' => 'upazila-edit', 'guard_name' => 'admin', 'group_name' => 'upazila'],
            ['name' => 'upazila-delete', 'guard_name' => 'admin', 'group_name' => 'upazila'],

            ['name' => 'area-list', 'guard_name' => 'admin', 'group_name' => 'area'],
            ['name' => 'area-create', 'guard_name' => 'admin', 'group_name' => 'area'],
            ['name' => 'area-show', 'guard_name' => 'admin', 'group_name' => 'area'],
            ['name' => 'area-edit', 'guard_name' => 'admin', 'group_name' => 'area'],
            ['name' => 'area-delete', 'guard_name' => 'admin', 'group_name' => 'area'],

            ['name' => 'rider-list', 'guard_name' => 'admin', 'group_name' => 'rider'],
            ['name' => 'rider-create', 'guard_name' => 'admin', 'group_name' => 'rider'],
            ['name' => 'rider-show', 'guard_name' => 'admin', 'group_name' => 'rider'],
            ['name' => 'rider-edit', 'guard_name' => 'admin', 'group_name' => 'rider'],
            ['name' => 'rider-delete', 'guard_name' => 'admin', 'group_name' => 'rider'],

            ['name' => 'weight-range-list', 'guard_name' => 'admin', 'group_name' => 'weight-range'],
            ['name' => 'weight-range-create', 'guard_name' => 'admin', 'group_name' => 'weight-range'],
            ['name' => 'weight-range-show', 'guard_name' => 'admin', 'group_name' => 'weight-range'],
            ['name' => 'weight-range-edit', 'guard_name' => 'admin', 'group_name' => 'weight-range'],
            ['name' => 'weight-range-delete', 'guard_name' => 'admin', 'group_name' => 'weight-range'],

            ['name' => 'merchant-list', 'guard_name' => 'admin', 'group_name' => 'merchant'],
            ['name' => 'merchant-create', 'guard_name' => 'admin', 'group_name' => 'merchant'],
            ['name' => 'merchant-show', 'guard_name' => 'admin', 'group_name' => 'merchant'],
            ['name' => 'merchant-edit', 'guard_name' => 'admin', 'group_name' => 'merchant'],
            ['name' => 'merchant-delete', 'guard_name' => 'admin', 'group_name' => 'merchant'],

            ['name' => 'delivery-charge-list', 'guard_name' => 'admin', 'group_name' => 'delivery-charge'],
            ['name' => 'delivery-charge-create', 'guard_name' => 'admin', 'group_name' => 'delivery-charge'],
            ['name' => 'delivery-charge-show', 'guard_name' => 'admin', 'group_name' => 'delivery-charge'],
            ['name' => 'delivery-charge-edit', 'guard_name' => 'admin', 'group_name' => 'delivery-charge'],
            ['name' => 'delivery-charge-delete', 'guard_name' => 'admin', 'group_name' => 'delivery-charge'],

            ['name' => 'parcel-type-list', 'guard_name' => 'admin', 'group_name' => 'parcel-type'],
            ['name' => 'parcel-type-create', 'guard_name' => 'admin', 'group_name' => 'parcel-type'],
            ['name' => 'parcel-type-show', 'guard_name' => 'admin', 'group_name' => 'parcel-type'],
            ['name' => 'parcel-type-edit', 'guard_name' => 'admin', 'group_name' => 'parcel-type'],
            ['name' => 'parcel-type-delete', 'guard_name' => 'admin', 'group_name' => 'parcel-type'],

            ['name' => 'pickup-request-list', 'guard_name' => 'admin', 'group_name' => 'pickup-request'],
            ['name' => 'pickup-request-create', 'guard_name' => 'admin', 'group_name' => 'pickup-request'],
            ['name' => 'pickup-request-show', 'guard_name' => 'admin', 'group_name' => 'pickup-request'],
            ['name' => 'pickup-request-edit', 'guard_name' => 'admin', 'group_name' => 'pickup-request'],
            ['name' => 'pickup-request-delete', 'guard_name' => 'admin', 'group_name' => 'pickup-request'],

            ['name' => 'parcel-list', 'guard_name' => 'admin', 'group_name' => 'parcel'],
            ['name' => 'parcel-create', 'guard_name' => 'admin', 'group_name' => 'parcel'],
            ['name' => 'parcel-show', 'guard_name' => 'admin', 'group_name' => 'parcel'],
            ['name' => 'parcel-edit', 'guard_name' => 'admin', 'group_name' => 'parcel'],
            ['name' => 'parcel-delete', 'guard_name' => 'admin', 'group_name' => 'parcel'],

            ['name' => 'expense-list', 'guard_name' => 'admin', 'group_name' => 'expense'],
            ['name' => 'expense-create', 'guard_name' => 'admin', 'group_name' => 'expense'],
            ['name' => 'expense-show', 'guard_name' => 'admin', 'group_name' => 'expense'],
            ['name' => 'expense-edit', 'guard_name' => 'admin', 'group_name' => 'expense'],
            ['name' => 'expense-delete', 'guard_name' => 'admin', 'group_name' => 'expense'],

            ['name' => 'invoice-list', 'guard_name' => 'admin', 'group_name' => 'invoice'],
            ['name' => 'invoice-create', 'guard_name' => 'admin', 'group_name' => 'invoice'],
            ['name' => 'invoice-show', 'guard_name' => 'admin', 'group_name' => 'invoice'],
            ['name' => 'invoice-edit', 'guard_name' => 'admin', 'group_name' => 'invoice'],
            ['name' => 'invoice-delete', 'guard_name' => 'admin', 'group_name' => 'invoice'],



            ['name' => 'env-dynamic', 'guard_name' => 'admin', 'group_name' => 'env-dynamic'],
            ['name' => 'reason', 'guard_name' => 'admin', 'group_name' => 'reason'],
            ['name' => 'form-batch-upload', 'guard_name' => 'admin', 'group_name' => 'batch-upload'],
            ['name' => 'expense-head-list', 'guard_name' => 'admin', 'group_name' => 'expense-head'],

            ['name' => 'collection-report', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'merchant-wise-parcel', 'guard_name' => 'admin', 'group_name' => 'report'],

            ['name' => 'date -wise-parcel', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'total-parcel-rider-wise', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'parcel-summary', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'merchant-parcel-summary', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'parcel-summary-in-merchant-wise', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'parcel-summary-in-rider-wise', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'cash-summary-report', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'rider-wise-parcel', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'due-list', 'guard_name' => 'admin', 'group_name' => 'due list'],
            ['name' => 'collection-summary', 'guard_name' => 'admin', 'group_name' => 'Collection Summary'],

            ['name' => 'advance-list', 'guard_name' => 'admin', 'group_name' => 'advance'],
            ['name' => 'advance-create', 'guard_name' => 'admin', 'group_name' => 'advance'],
            ['name' => 'area-wise-parcel', 'guard_name' => 'admin', 'group_name' => 'report'],
            ['name' => 'set-delivery-charge', 'guard_name' => 'admin', 'group_name' => 'delivery-charge '],
            ['name' => 'edit-set-delivery-charge', 'guard_name' => 'admin', 'group_name' => 'delivery-charge '],

            ['name' => 'loan-list', 'guard_name' => 'admin', 'group_name' => 'loan'],
            ['name' => 'loan-create', 'guard_name' => 'admin', 'group_name' => 'loan'],
            ['name' => 'loan-show', 'guard_name' => 'admin', 'group_name' => 'loan'],
            ['name' => 'loan-edit', 'guard_name' => 'admin', 'group_name' => 'loan'],
            ['name' => 'loan-delete', 'guard_name' => 'admin', 'group_name' => 'loan'],

            ['name' => 'bad-debt-list', 'guard_name' => 'admin', 'group_name' => 'bad-debt'],
            ['name' => 'bad-debt-create', 'guard_name' => 'admin', 'group_name' => 'bad-debt'],
            ['name' => 'bad-debt-show', 'guard_name' => 'admin', 'group_name' => 'bad-debt'],
            ['name' => 'bad-debt-edit', 'guard_name' => 'admin', 'group_name' => 'bad-debt'],
            ['name' => 'bad-debt-delete', 'guard_name' => 'admin', 'group_name' => 'bad-debt'],

            ['name' => 'balance-sheet', 'guard_name' => 'admin', 'group_name' => 'balance-sheet'],
            ['name' => 'goto-dashboard-rider', 'guard_name' => 'admin', 'group_name' => 'dashboard'],
            ['name' => 'goto-dashboard-merchant', 'guard_name' => 'admin', 'group_name' => 'dashboard'],
            ['name' => 'reset-rider-password', 'guard_name' => 'admin', 'group_name' => 'password'],

            ['name' => 'reason-list', 'guard_name' => 'admin', 'group_name' => 'reason'],
            ['name' => 'reason-create', 'guard_name' => 'admin', 'group_name' => 'reason'],
            ['name' => 'reason-show', 'guard_name' => 'admin', 'group_name' => 'reason'],
            ['name' => 'reason-edit', 'guard_name' => 'admin', 'group_name' => 'reason'],
            ['name' => 'reason-delete', 'guard_name' => 'admin', 'group_name' => 'reason'],

            ['name' => 'attendance-list', 'guard_name' => 'admin', 'group_name' => 'attendance'],
            ['name' => 'attendance-create', 'guard_name' => 'admin', 'group_name' => 'attendance'],
            ['name' => 'attendance-show', 'guard_name' => 'admin', 'group_name' => 'attendance'],
            ['name' => 'attendance-edit', 'guard_name' => 'admin', 'group_name' => 'attendance'],
            ['name' => 'attendance-delete', 'guard_name' => 'admin', 'group_name' => 'attendance'],

            ['name' => 'payroll-list', 'guard_name' => 'admin', 'group_name' => 'payroll'],
            ['name' => 'payroll-create', 'guard_name' => 'admin', 'group_name' => 'payroll'],
            ['name' => 'payroll-show', 'guard_name' => 'admin', 'group_name' => 'payroll'],
            ['name' => 'payroll-edit', 'guard_name' => 'admin', 'group_name' => 'payroll'],
            ['name' => 'payroll-delete', 'guard_name' => 'admin', 'group_name' => 'payroll'],

            ['name' => 'leave-type-list', 'guard_name' => 'admin', 'group_name' => 'leave-type'],
            ['name' => 'leave-type-create', 'guard_name' => 'admin', 'group_name' => 'leave-type'],
            ['name' => 'leave-type-show', 'guard_name' => 'admin', 'group_name' => 'leave-type'],
            ['name' => 'leave-type-edit', 'guard_name' => 'admin', 'group_name' => 'leave-type'],
            ['name' => 'leave-type-delete', 'guard_name' => 'admin', 'group_name' => 'leave-type'],

            ['name' => 'accounts-collection', 'guard_name' => 'admin', 'group_name' => 'collection'],
            ['name' => 'accounts-collection-history', 'guard_name' => 'admin', 'group_name' => 'collection'],
            ['name' => 'incharge-collection', 'guard_name' => 'admin', 'group_name' => 'collection'],
            ['name' => 'incharge-collection-history', 'guard_name' => 'admin', 'group_name' => 'collection'],
            
            ['name' => 'advance-edit', 'guard_name' => 'admin', 'group_name' => 'advance'],
            ['name' => 'advance-show', 'guard_name' => 'admin', 'group_name' => 'advance'],
            ['name' => 'advance-delete', 'guard_name' => 'admin', 'group_name' => 'advance'],

            ['name' => 'direct-batch-upload', 'guard_name' => 'admin', 'group_name' => 'batch-upload'],


            ['name' => 'investment-list', 'guard_name' => 'admin', 'group_name' => 'investment'],
            ['name' => 'investment-create', 'guard_name' => 'admin', 'group_name' => 'investment'],
            ['name' => 'investment-show', 'guard_name' => 'admin', 'group_name' => 'investment'],
            ['name' => 'investment-edit', 'guard_name' => 'admin', 'group_name' => 'investment'],
            ['name' => 'investment-delete', 'guard_name' => 'admin', 'group_name' => 'investment'],

            ['name' => 'cancle-invoice-list', 'guard_name' => 'admin', 'group_name' => 'cancle-invoice'],
            ['name' => 'cancle-invoice-create', 'guard_name' => 'admin', 'group_name' => 'cancle-invoice'],
            ['name' => 'customer-export', 'guard_name' => 'admin', 'group_name' => 'customer-export'],

            ['name' => 'incharge-invoice-list', 'guard_name' => 'admin', 'group_name' => 'incharge-invoice'],
            ['name' => 'incharge-invoice-create', 'guard_name' => 'admin', 'group_name' => 'incharge-invoice'],
            ['name' => 'print-parcel', 'guard_name' => 'admin', 'group_name' => 'print-parcel'],
            ['name' => 'date-adjust', 'guard_name' => 'admin', 'group_name' => 'date-adjust'],
            ['name' => 'rider-invoice-list', 'guard_name' => 'admin', 'group_name' => 'rider-invoice'],

          
            ['name' => 'expense-head-create', 'guard_name' => 'admin', 'group_name' => 'expense-head'],
            ['name' => 'expense-head-show', 'guard_name' => 'admin', 'group_name' => 'expense-head'],
            ['name' => 'expense-head-edit', 'guard_name' => 'admin', 'group_name' => 'expense-head'],
            ['name' => 'expense-head-delete', 'guard_name' => 'admin', 'group_name' => 'expense-head'],

            ['name' => 'assign-parcel', 'guard_name' => 'admin', 'group_name' => 'assign'],
            ['name' => 'reassign-parcel', 'guard_name' => 'admin', 'group_name' => 'assign'],


        ];

        DB::table('permissions')->insert($data);
        //Data for role user pivot
        $data = [
            ['role_id' => 1, 'model_type' => 'App\Models\Admin', 'model_id' => $dev->id],
            ['role_id' => 2, 'model_type' => 'App\Models\Admin', 'model_id' => 2],
            ['role_id' => 3, 'model_type' => 'App\Models\Admin', 'model_id' => 3],
            ['role_id' => 4, 'model_type' => 'App\Models\Admin', 'model_id' => 4],
            ['role_id' => 5, 'model_type' => 'App\Models\Admin', 'model_id' => 5],
        ];
        DB::table('model_has_roles')->insert($data);
        //Data for role permission pivot
        $permissions = Permission::all();
        foreach ($permissions as $key => $value) {
            $data = [
                ['permission_id' => $value->id, 'role_id' => 1],
            ];

            DB::table('role_has_permissions')->insert($data);
        }


        // $count_permission = DB::table('permissions')->count();
        // $count_role = DB::table('roles')->count();

        // for ($i = 1; $i <= $count_role; $i++) {
        //     $data = [];
        //     for ($j = 1; $j <= $count_permission; $j++) {
        //         $data[$j]['permission_id'] = $j;
        //         $data[$j]['role_id'] = $i;
        //     }
        //     DB::table('role_has_permissions')->insert($data);
        //}
    }
}
