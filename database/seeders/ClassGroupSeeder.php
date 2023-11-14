<?php

namespace Database\Seeders;

use App\Models\SchoolClass;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $e = SchoolClass::where('class_name', 'Nine')->first();
        $e->groups()->create([
            'group_name' => 'Science'
        ]);
        $e->groups()->create([
            'group_name' => 'Commerce'
        ]);
        $e->groups()->create([
            'group_name' => 'Humanities'
        ]);

        $e = SchoolClass::where('class_name', 'Ten')->first();
        $e->groups()->create([
            'group_name' => 'Science'
        ]);
        $e->groups()->create([
            'group_name' => 'Commerce'
        ]);
        $e->groups()->create([
            'group_name' => 'Humanities'
        ]);
    }
}
