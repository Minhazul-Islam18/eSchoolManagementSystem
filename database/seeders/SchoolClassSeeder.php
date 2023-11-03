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
            'class_name' => 'One',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Two',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Three',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Four',
        ]);
        SchoolClass::updateOrCreate([
            'school_id' => $e->id,
            'class_name' => 'Five',
        ]);
    }
}
