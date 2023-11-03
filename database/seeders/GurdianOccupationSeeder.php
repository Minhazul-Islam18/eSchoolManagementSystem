<?php

namespace Database\Seeders;

use App\Models\GurdianOccupation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GurdianOccupationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GurdianOccupation::create(['name' => 'ব্যবসায়ি']);
        GurdianOccupation::create(['name' => 'কৃষক']);
        GurdianOccupation::create(['name' => 'কৃষি শ্রমিক']);
        GurdianOccupation::create(['name' => 'ডাক্তার']);
        GurdianOccupation::create(['name' => 'জেলে']);
        GurdianOccupation::create(['name' => 'সরকারি চাকুরি']);
        GurdianOccupation::create(['name' => 'কামার/কুমোর']);
        GurdianOccupation::create(['name' => 'প্রবাসি']);
        GurdianOccupation::create(['name' => 'ক্ষুদ্র ব্যবসায়ি']);
        GurdianOccupation::create(['name' => 'শিক্ষক']);
        GurdianOccupation::create(['name' => 'অকৃষি শ্রমিক']);
        GurdianOccupation::create(['name' => 'অন্যান্য']);
    }
}
