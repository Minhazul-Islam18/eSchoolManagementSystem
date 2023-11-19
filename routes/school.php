<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Backend\School\Dashboard;
use App\Livewire\Backend\School\ExamManagement;
use App\Livewire\Backend\School\ClassManagement;
use App\Livewire\Backend\School\StaffManagement;
use App\Livewire\Backend\School\ExamFeeManagement;
use App\Livewire\Backend\School\GeneralInformation;
use App\Livewire\Backend\School\AdmissionManagement;
use App\Livewire\Backend\School\AdmissionFormPreview;
use App\Livewire\Backend\School\ClassGroupManagement;
use App\Livewire\Backend\School\ClassRoutineManagement;
use App\Livewire\Backend\School\ExamResultManagement;
use App\Livewire\Backend\School\ClassSectionManagement;
use App\Livewire\Backend\School\ClassSectionSubjectManagement;
use App\Livewire\Backend\School\ClassSyllabusManagement;
use App\Livewire\Backend\School\FeeCategoryManagement;
use App\Livewire\Backend\School\GradingManagement;
use App\Livewire\Backend\School\GradingRuleManagement;
use App\Livewire\Backend\School\NoticeEdit;
use App\Livewire\Backend\School\NoticeManagement;

Route::get('/dashboard', Dashboard::class)->name('index');
Route::get('/staffs', StaffManagement::class)->name('staffs');
Route::get('/classes', ClassManagement::class)->name('classes');
Route::get('/groups', ClassGroupManagement::class)->name('groups');
Route::get('/sections', ClassSectionManagement::class)->name('sections');
Route::get('/subjects', ClassSectionSubjectManagement::class)->name('subjects');
Route::get('/exams', ExamManagement::class)->name('exams');
Route::get('/syllabuses', ClassSyllabusManagement::class)->name('syllabuses');
Route::get('/routines', ClassRoutineManagement::class)->name('routines');
Route::get('/notices', NoticeManagement::class)->name('notices');
Route::get('/notice/{slug}', NoticeEdit::class)->name('notice.slug');
Route::get('/fee-categories', FeeCategoryManagement::class)->name('fee-categories');
Route::get('/all-fees', ExamFeeManagement::class)->name('all-fees');
Route::get('/exam-results', ExamResultManagement::class)->name('exam-results');
Route::get('/admissions', AdmissionManagement::class)->name('admissions');
Route::get('/grading', GradingManagement::class)->name('grading');
Route::get('/grading-rule/{id}', GradingRuleManagement::class)->name('grading-rule');
Route::get('/admissions/{admission_id}', AdmissionFormPreview::class)->name('admissions.show');
Route::get('/general-information', GeneralInformation::class)->name('general-information');
// Route::group(['as' => 'student'], function () {
//     Route::get('/', function () {
//         dd('Student');
//     })->name('index');
// });
