<?php

namespace App\Console\Commands;

use App\Models\classGroup;
use App\Models\SchoolClassSection;
use App\Models\SchoolStaff;
use Mpdf\Tag\Section;
use Illuminate\Console\Command;

class MarkAttendanceDaily extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:mark-attendance-daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Schedulaer will run on daily';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sections = SchoolClassSection::all();

        foreach ($sections as $section) {
            $students = $section->students;
            foreach ($students as $student) {
                $student->attendances()->create([
                    'school_id' => $student->school_id,
                    'date' => now()->toDateString(),
                    'is_present' => false,
                ]);
            }
        }

        $groups = classGroup::all();

        foreach ($groups as $section) {
            $students = $section->students;
            foreach ($students as $student) {
                $student->attendances()->create([
                    'school_id' => $student->school_id,
                    'date' => now()->toDateString(),
                    'is_present' => false,
                ]);
            }
        }

        $this->info('Daily attendance marked for all sections & groups.');

        $staffs = SchoolStaff::where('status', '!=', 0)->get();

        foreach ($staffs as $staff) {
            $staff->attendances()->create([
                'school_id' => $staff->school_id,
                'date' => now()->toDateString(),
                'is_present' => false,
            ]);
        }
        $this->info('Daily attendance marked for all staffs.');
    }
}
