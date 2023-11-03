<?php

namespace Database\Seeders;

use App\Models\StudentQuota;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentQuotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        StudentQuota::create(['name' => 'মুক্তিযোদ্ধার সন্তান/নাতী-নাতনী']);
        StudentQuota::create(['name' => 'অত্র বিদ্যালয়ে কর্মরত শিক্ষক, কর্মচারী ও ম্যানেজিং কমিটির সন্তান']);
        StudentQuota::create(['name' => 'প্রতিবন্ধী']);
        StudentQuota::create(['name' => 'সাধারণ কোটা']);
        StudentQuota::create(['name' => 'কোন কোটা নেই']);
    }
}
