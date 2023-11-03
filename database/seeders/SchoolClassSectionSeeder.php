<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassSection;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolClassSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $e = SchoolClass::findOrFail(1);
        SchoolClassSection::updateOrCreate([
            'school_class_id' => $e->id,
            'school_id' => 1,
            'section_name' => 'Padma'
        ]);
        SchoolClassSection::updateOrCreate([
            'school_class_id' => $e->id,
            'school_id' => 1,
            'section_name' => 'Meghna'
        ]);
        SchoolClassSection::updateOrCreate([
            'school_class_id' => $e->id,
            'school_id' => 1,
            'section_name' => 'Padma'
        ]);
    }
}
