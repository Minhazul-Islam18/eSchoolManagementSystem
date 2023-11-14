<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SchoolClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $e = School::first();
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Six',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Seven',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Eight',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Nine',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Ten',
        ]);
    }
}
