<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\PermissionSeeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FrontendPageSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(SchoolStaffSeeder::class);
        $this->call(SchoolClassSeeder::class);
        $this->call(ClassGroupSeeder::class);
        $this->call(SchoolClassSectionSeeder::class);
        $this->call(SchoolClassSubjectSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(StudentCategorySeeder::class);
        $this->call(StudentQuotaSeeder::class);
        $this->call(GurdianOccupationSeeder::class);
        $this->call(SchoolFeeCategorySeeder::class);
        Artisan::call('BangladeshGeocode:setup');
    }
}
