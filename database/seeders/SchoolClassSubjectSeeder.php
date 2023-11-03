<?php

namespace Database\Seeders;

use App\Models\School;
use App\Models\SchoolClass;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchoolClassSubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $c = SchoolClass::findOrFail(1);
        $ss = SchoolClassSection::first();
        $s = School::first();
        SchoolClassSubject::updateOrCreate([
            'subject_name' => 'Bangla',
            'school_class_section_id' => $ss->id,
            'school_class_id' => $c->id,
            'school_id' => $s->id,
        ]);
        SchoolClassSubject::updateOrCreate([
            'subject_name' => 'English',
            'school_class_section_id' => $ss->id,
            'school_class_id' => $c->id,
            'school_id' => $s->id,
        ]);
        SchoolClassSubject::updateOrCreate([
            'subject_name' => 'Arabic',
            'school_class_section_id' => $ss->id,
            'school_class_id' => $c->id,
            'school_id' => $s->id,
        ]);
    }
}
