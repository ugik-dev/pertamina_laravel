<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * php artisan db:seed --class=RoleSeeder
     */
    public function run(): void
    {
        // echo "Roleseeder running";
        // \DB::table('permissions')->delete();
        // \DB::table('role_has_permissions')->delete();
        \Artisan::call('permission:cache-reset');

        $super_admin = Role::updateOrCreate(['id' => 1, 'name' => 'super', 'title' => 'Super Admin']);
        $kepala = Role::updateOrCreate(['id' => 2, 'name' => 'head', 'title' => 'Manager']);
        $doctor = Role::updateOrCreate(['id' => 3, 'name' => 'doctor', 'title' => 'Doctor']);
        $admin = Role::updateOrCreate(['id' => 4, 'name' => 'admin', 'title' => 'Admin']);
        $staf = Role::updateOrCreate(['id' => 5, 'name' => 'staf', 'title' => 'Staf']);
        $tangguhan = Role::updateOrCreate(['id' => 6, 'name' => 'tangguhan', 'title' => 'Tangguhan']);
        $security = Role::updateOrCreate(['id' => 7, 'name' => 'security', 'title' => 'Security']);

        $respon_call = Permission::updateOrCreate(['name' => 'respon_call']);
        $crud_users = Permission::updateOrCreate(['name' => 'crud_users']);
        $crud_screening = Permission::updateOrCreate(['name' => 'crud_screening']);
        $crud_information = Permission::updateOrCreate(['name' => 'crud_information']);
        $is_doctor = Permission::updateOrCreate(['name' => 'is_doctor']);
        $is_security = Permission::updateOrCreate(['name' => 'is_security']);
        // Assign Permissions to Roles
        $super_admin->givePermissionTo([$respon_call, $crud_users, $crud_information, $crud_screening]);
        $admin->givePermissionTo([$crud_information, $crud_screening]);
        $doctor->givePermissionTo([$crud_users, $crud_information, $crud_screening, $is_doctor]);
        $security->givePermissionTo($is_security);
    }
}
