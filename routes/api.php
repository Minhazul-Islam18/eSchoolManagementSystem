<?php

use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Search API for ID card generate page
Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::get('classes', function (Request $request) {
        $searchValue = $request->search;

        if ($searchValue !== null) {
            $result =  SchoolClass::where('school_id', school()->id)->where('class_name', 'like', '%' . $searchValue . '%')->get();
        } else {
            $result =  SchoolClass::allClasses();
        }

        return $result;
    })->name('api.classes');


    Route::get('students', function (Request $request) {
        $searchValue = $request->search;

        if ($searchValue !== null) {
            $result =  Student::where('school_id', school()->id)
                ->where('name_en', 'like', '%' . $searchValue . '%')
                ->orWhere('roll', 'like', '%' . $searchValue . '%')
                ->get();
        } else {
            $result =  Student::allStudents();
        }

        return $result;
    })->name('api.students');

    Route::get('get-students', function (Request $request) {
        $students = [];
        if ($request->search === null && $request->class_id !== null && $request->section_id !== null || $request->group_id !== null) {
            $row = isset($request->section_id) ? 'school_class_section_id' : 'class_group_id';
            $students =  Student::where('school_id', school()->id)
                ->where('school_class_id', $request->class_id)
                ->where($row, $request->section_id ?? $request->group_id)
                ->get();
        } else if ($request->search !== null && $request->class_id !== null && $request->section_id !== null || $request->group_id !== null) {
            $row = isset($request->section_id) ? 'school_class_section_id' : 'class_group_id';
            $students =  Student::where('school_id', school()->id)
                ->where('school_class_id', $request->class_id)
                ->where($row, $request->section_id ?? $request->group_id)
                ->where('name_en', 'like', '%' . $request->search . '%')
                ->orWhere('roll', 'like', '%' . $request->search . '%')
                ->get();
        }

        return $students;
    })->name('api.students-by-class-section');
});
