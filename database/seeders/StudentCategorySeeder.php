<?php

namespace Database\Seeders;

use App\Models\StudentCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudentCategory::create(['name' => 'কর্মজীবী শিক্ষার্থী']);
        StudentCategory::create(['name' => 'ভূমিহীন অভিভাবকের সন্তান']);
        StudentCategory::create(['name' => 'মুক্তিযোদ্ধা পোষা/নাতি-নাতনি']);
        StudentCategory::create(['name' => 'ক্ষুদ্র নৃ-গোষ্ঠী শিক্ষার্থী']);
        StudentCategory::create(['name' => 'বিশেষ চাহিদা সম্পন্ন শিক্ষার্থী']);
        StudentCategory::create(['name' => 'অনাথ/এতিম শিক্ষা']);
        StudentCategory::create(['name' => 'অন্যান্য']);
    }
}
