<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // صلاحيات الادمن
        // Permission::create(['name' => 'Create-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Read-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Update-', 'guard_name' => 'admin']);
        // Permission::create(['name' => 'Delete-', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Roles', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Role', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Role', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Permissions', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Permission', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Permission', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Admins', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Admin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Admin', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Users', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-User', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-User', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Currency', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Currencies', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Currency', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Currency', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Create-Course', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Courses', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Course', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Course', 'guard_name' => 'admin']);


        Permission::create(['name' => 'Read-AllCourses', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-AllAdmin', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-AllDeposits', 'guard_name' => 'admin']);



        Permission::create(['name' => 'Read-Courses', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-AllCourses', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-AllAdmin', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-AllDeposits', 'guard_name' => 'user']);


        Permission::create(['name' => 'Create-Deposit', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Read-Deposits', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Update-Deposit', 'guard_name' => 'admin']);
        Permission::create(['name' => 'Delete-Deposit', 'guard_name' => 'admin']);

        Permission::create(['name' => 'Create-Deposit', 'guard_name' => 'user']);
        Permission::create(['name' => 'Read-Deposits', 'guard_name' => 'user']);
    }
}
