<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolExamResult;
use App\Models\SchoolClassSection;
use App\Models\SchoolExam;
use App\Models\Student;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ExamResultManagement extends Component
{
    use LivewireAlert;
    #[Title('Exam result management')]
    public $editable_item;
    public $class_id;
    public $section_id;
    public $student_id;
    public $school_exam_id;
    public $sections = [];
    public $students = [];
    public $obtained_marks;
    public $exams = [];
    public $openCEmodal = false;
    public $filter_class_id;
    public $filter_section_id;
    public $filter_exam_id;
    public function getSection()
    {
        if (null != $this->class_id || null != $this->filter_class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id ??  $this->filter_class_id)
                ->where('school_id', school()->id)
                ->get();
        }
    }
    public function getStudents()
    {
        if (null != $this->class_id && null != $this->section_id) {
            $this->students = SchoolClassSection::students($this->section_id);
        }
        $this->getExams();
    }
    public function getExams()
    {
        if (null != $this->filter_section_id && null != $this->filter_class_id || null != $this->class_id && null != $this->section_id) {
            $this->exams = SchoolExam::where('school_id', school()->id)
                ->where('school_class_id', $this->class_id ?? $this->filter_class_id)
                ->where('school_class_section_id', $this->section_id ?? $this->filter_section_id)
                ->get();
        }
    }
    public function store()
    {
        abort_action(school()->user_id);
        $this->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'school_exam_id' => 'required',
            'section_id' => 'required',
            'obtained_marks' => 'required|min:1'
        ]);
        SchoolExamResult::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'school_exam_id' => $this->school_exam_id,
            'student_id' => $this->student_id,
            'mark_obtained' => $this->obtained_marks,
            'school_id' => school()->id
        ]);
        $this->resetFields();
        $this->alert('success', 'Exam result created.');
    }
    public function edit(SchoolExamResult $schoolExamResult)
    {
        abort_action($schoolExamResult->school->user_id);
        $this->editable_item = $schoolExamResult;
        $this->class_id = $schoolExamResult->school_class_id;
        $this->student_id = $schoolExamResult->student_id;
        $this->school_exam_id = $schoolExamResult->school_exam_id;
        $this->section_id = $schoolExamResult->school_class_section_id;
        $this->obtained_marks = $schoolExamResult->mark_obtained;
        $this->getSection();
        $this->getExams();
        $this->getStudents();
    }
    public function update()
    {
        abort_action(school()->user_id);
        $this->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'school_exam_id' => 'required',
            'section_id' => 'required',
            'obtained_marks' => 'required|min:1'
        ]);
        $e = SchoolExamResult::findBySchool($this->editable_item->id);
        $e->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'school_exam_id' => $this->school_exam_id,
            'student_id' => $this->student_id,
            'mark_obtained' => $this->obtained_marks,
            'school_id' => school()->id
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Exam result updated');
        $this->resetFields();
    }
    public function destroy(SchoolExamResult $schoolExamResult)
    {
        abort_action($schoolExamResult->school->user_id);
        $schoolExamResult->delete();
        $this->alert('success', 'Exam result deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->class_id = null;
        $this->section_id = null;
        $this->school_exam_id = null;
        $this->student_id = null;
        $this->obtained_marks = null;
        $this->openCEmodal = false;
    }
    public function getSectionRefresh()
    {
        $this->getSection();
        $this->render();
    }
    public function getExamRefresh()
    {
        $this->getExams();
        $this->render();
    }
    public function refresh()
    {
        $this->render();
    }
    public function render()
    {
        $this->dispatch('mounted');

        if ($this->filter_class_id != null && $this->filter_section_id && $this->filter_exam_id) {
            $results = SchoolExamResult::where('school_class_id', $this->filter_class_id)
                ->where('school_class_section_id', $this->filter_section_id)
                ->where('school_exam_id', $this->filter_exam_id)
                ->get();
        } else {
            $results = SchoolExamResult::allResults();
        }
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.exam-result-management')->with([
            'results' => $results,
            'classes' => $classes,
        ]);
    }
}
