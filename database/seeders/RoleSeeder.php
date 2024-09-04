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
     */
    public function run(): void
    {
        $super_admin = Role::updateOrCreate(['id' => 1, 'name' => 'super', 'title' => 'Super Admin']);
        $kepala = Role::updateOrCreate(['id' => 2, 'name' => 'head', 'title' => 'Manager']);
        $doctor = Role::updateOrCreate(['id' => 3, 'name' => 'doctor', 'title' => 'Doctor']);
        $admin = Role::updateOrCreate(['id' => 4, 'name' => 'admin', 'title' => 'Admin']);
        $staf = Role::updateOrCreate(['id' => 5, 'name' => 'staf', 'title' => 'Staf']);

        $respon_call = Permission::updateOrCreate(['name' => 'respon_call']);
        $crud_users = Permission::updateOrCreate(['name' => 'crud_users']);
        $crud_screening = Permission::updateOrCreate(['name' => 'crud_screening']);
        $crud_information = Permission::updateOrCreate(['name' => 'crud_information']);
        $super_admin->givePermissionTo([$respon_call, $crud_users, $crud_information, $crud_screening]);
        $admin->givePermissionTo([$crud_information, $crud_screening]);
        $doctor->givePermissionTo([$crud_information, $crud_screening]);
    }
}
