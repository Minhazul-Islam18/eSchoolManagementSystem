<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = Permission::all();
        Role::updateOrCreate(['name' => 'Admin', 'slug' => 'admin', 'is_deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));
        Role::updateOrCreate(['name' => 'Super Admin', 'slug' => 'super_admin', 'is_deletable' => false])
            ->permissions()
            ->sync($admin_permissions->pluck('id'));

        Role::updateOrCreate(['name' => 'User', 'slug' => 'user', 'is_deletable' => false]);
        Role::updateOrCreate(['name' => 'School', 'slug' => 'school', 'is_deletable' => false]);
        Role::updateOrCreate(['name' => 'Demo school', 'slug' => 'demo_school', 'is_deletable' => false]);
        Role::updateOrCreate(['name' => 'Student', 'slug' => 'student', 'is_deletable' => false]);
    }
}
