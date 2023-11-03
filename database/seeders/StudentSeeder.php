<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create school
        $userRole = Role::where('slug', 'student')->first();
        // $u = User::findOrFail(4);
        $a = User::updateOrCreate([
            'role_id' => $userRole->id,
            'name' => 'Test student 1',
            'email' => 'student1@mail.com',
            'password' => 'password',
            'status' => true,
        ]);
        Student::updateOrCreate([
            'user_id' => $a->id,
            'school_id' => 1,
        ]);
        $b = User::updateOrCreate([
            'role_id' => $userRole->id,
            'name' => 'Test student 2',
            'email' => 'student2@mail.com',
            'password' => 'password',
            'status' => true,
        ]);
        Student::updateOrCreate([
            'user_id' => $b->id,
            'school_id' => 1,
        ]);
        $c =  User::updateOrCreate([
            'role_id' => $userRole->id,
            'name' => 'Test student 3',
            'email' => 'student3@mail.com',
            'password' => 'password',
            'status' => true,
        ]);
        Student::updateOrCreate([
            'school_id' => null,
            'user_id' => $c->id,
        ]);
    }
}
