<?php

namespace App\Console\Commands;

use App\Models\School;
use Illuminate\Console\Command;

class AddMonthlyFees extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fees:add-monthly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get all schools
        $schools = School::all();

        foreach ($schools as $school) {
            // Get all classes in the school
            $classes = $school->classes;

            foreach ($classes as $class) {
                // Get all students in the class
                $students = $class->students;

                foreach ($students as $student) {
                    if (isset($student->school_class->monthly_fee, $class->monthly_fee)) {
                        // Add the monthly fee for each student
                        $pivotData = ([
                            'school_id' => $class->school_id,
                            'due_amount' => $class->monthly_fee->amount ?? '',
                            'month' => now()->format('F'),
                        ]);
                        $student->monthlyFees()->save($student->school_class->monthly_fee, $pivotData);
                    }
                }
            }
        }

        $this->info('Monthly fees added successfully.');
    }
}
