<?php

namespace Database\Seeders;

use App\Models\SchoolFeeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolFeeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolFeeCategory::create([
            'category_name' => 'Half yearly',
            'category_slug' => 'half_yearly',
        ]);
        SchoolFeeCategory::create([
            'category_name' => 'Annual',
            'category_slug' => 'annual',
        ]);
        SchoolFeeCategory::create([
            'category_name' => 'Admission',
            'category_slug' => 'admission',
        ]);
    }
}
