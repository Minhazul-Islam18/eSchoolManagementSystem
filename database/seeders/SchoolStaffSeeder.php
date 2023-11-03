<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SchoolStaff;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolStaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SchoolStaff::updateOrCreate([
            'image' => 'https://placehold.co/100x100.png',
            'type' => 'teacher',
            'name' => 'Jhon Doe',
            'gender' => 'male',
            'joined_at' => now(),
            'school_id' => School::first()->id,
        ]);
    }
}
