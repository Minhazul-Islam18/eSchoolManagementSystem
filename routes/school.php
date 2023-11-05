<?php

use App\Livewire\Backend\School\AdmissionManagement;
use App\Livewire\Backend\School\ClassManagement;
use App\Livewire\Backend\School\ClassSectionManagement;
use App\Livewire\Backend\School\ClassSectionSubjectManagement;
use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\School\Dashboard;
use App\Livewire\Backend\School\ExamFeeManagement;
use App\Livewire\Backend\School\ExamManagement;
use App\Livewire\Backend\School\ExamResultManagement;
use App\Livewire\Backend\School\GeneralInformation;
use App\Livewire\Backend\School\StaffManagement;
use App\Livewire\School\AdmissionFormPreview;

Route::get('/dashboard', Dashboard::class)->name('index');
Route::get('/staffs', StaffManagement::class)->name('staffs');
Route::get('/classes', ClassManagement::class)->name('classes');
Route::get('/sections', ClassSectionManagement::class)->name('sections');
Route::get('/subjects', ClassSectionSubjectManagement::class)->name('subjects');
Route::get('/exams', ExamManagement::class)->name('exams');
Route::get('/exam-fees', ExamFeeManagement::class)->name('exam-fees');
Route::get('/exam-results', ExamResultManagement::class)->name('exam-results');
Route::get('/admissions', AdmissionManagement::class)->name('admissions');
Route::get('/admissions/{admission_id}', AdmissionFormPreview::class)->name('admissions.show');
Route::get('/general-information', GeneralInformation::class)->name('general-information');
// Route::group(['as' => 'student'], function () {
//     Route::get('/', function () {
//         dd('Student');
//     })->name('index');
// });
