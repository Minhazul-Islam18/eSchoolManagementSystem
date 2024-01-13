<?php

namespace App\Livewire\Backend\School;

use Exception;
use App\Models\School;
use App\Models\Student;
use Livewire\Component;
use App\Models\classGroup;
use App\Models\SchoolExam;
use App\Models\SchoolClass;
use Livewire\Attributes\Title;
use App\Models\SchoolExamResult;
use App\Models\SchoolClassSection;
use App\Models\SchoolClassSubject;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ExamResultManagement extends Component
{
    use LivewireAlert;
    #[Title('Exam result management')]
    public $editable_item;
    public $class_id;
    public $section_id;
    public $group_id;
    public $subject_id;
    public $student_id;
    public $school_exam_id;
    public $sections = [];
    public $subjects = [];
    public $students = [];
    public $obtained_marks;
    public $groups = [];
    public $exams = [];
    public $openCEmodal = false;
    public $filter_class_id;
    public $filter_section_id;
    public $filter_subject_id;
    public $filter_exam_id;
    public $theory;
    public $mcq;
    public $practical;
    // public function checkGrading()
    // {
    //     dd(School::gradingRule(school(), $this->section_id));
    //     if (School::gradingRule(school(), $this->section_id) != null) {
    //         return true;
    //     }
    //     return false;
    // }


    public function getSection()
    {
        if ($this->editable_item == null) {
            $this->section_id = null;
            $this->group_id = null;
        }

        if (null != $this->filter_class_id || isset($this->class_id)) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->filter_class_id ?? $this->class_id)->where('school_id', school()->id)->get();
        }
        //If class had no sections, then get all groups.
        if (!sizeof($this->sections)) {
            $this->getGroups();
        } else {
            $this->groups = [];
        }
    }

    public function getGroups()
    {
        if (null != $this->filter_class_id || isset($this->class_id)) {
            $this->groups = school()->classes()->findOrFail($this->filter_class_id ?? $this->class_id)->groups;
        }
    }

    public function check_if_grade_exist()
    {
        if (isset($this->section_id)) {
            return SchoolClassSection::findBySchool($this->section_id)->grades->isEmpty();
        }

        if (isset($this->group_id)) {
            return classGroup::findBySchool($this->group_id)->grades->isEmpty();
        }
    }

    public function getSubjects()
    {
        $this->check_if_grade_exist();
        if ($this->filter_section_id != null &&  $this->filter_class_id != null || $this->class_id != null || $this->section_id != null) {
            $this->subjects = SchoolClassSubject::where('school_class_id', $this->filter_class_id ?? $this->class_id)
                ->where('school_class_section_id', $this->filter_section_id ?? $this->section_id)
                ->where('school_id', school()->id)
                ->get();
        }
        if (isset($this->group_id)) {
            $this->subjects = classGroup::findOrFail($this->group_id)->subjects;
        }

        //Load all exams
        $this->getExams();
    }
    public function getStudents()
    {
        if (null != $this->class_id && null != $this->section_id) {
            $this->students = SchoolClassSection::findOrFail($this->section_id)->students;
        }

        if (isset($this->group_id)) {
            $this->students = classGroup::findOrFail($this->group_id)->students;
        }
    }
    public function getExams()
    {
        if (null != $this->filter_section_id && null != $this->filter_class_id || null != $this->class_id && null != $this->section_id) {
            $this->exams = SchoolExam::where('school_id', school()->id)
                ->where('school_class_id', $this->class_id ?? $this->filter_class_id)
                ->where('school_class_section_id', $this->section_id ?? $this->filter_section_id)
                ->get();
        }

        if (isset($this->group_id)) {
            $this->exams = classGroup::findOrFail($this->group_id)->exams;
        }

        $this->getStudents();
    }
    public function store()
    {
        Gate::authorize('school.exam-results.create');
        abort_action(school()->user_id);
        $this->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'school_exam_id' => 'required',
            'theory' => 'required',
            'mcq' => 'required',
            'practical' => 'required',
        ]);
        $type = isset($this->group_id) ? 'group' : 'section';
        $result = School::gradingRule(school(), $this->group_id ?? $this->section_id, $type);

        if ($result == null) {
            throw new Exception('This grade doesn\'t have any rule, Please set rule for this.', 203);
        }
        $totalNumber = $this->theory + $this->mcq + $this->practical;
        $e = $result->gradingRules->where('starts_at', '<=', $totalNumber)
            ->where('ends_at', '>=', $totalNumber)
            ->first();

        if ($e == null) {
            throw new Exception('This total number doesn\'t have any rule, Please set rule for this.', 203);
        }
        SchoolExamResult::create([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'school_class_subject_id' => $this->subject_id,
            'school_exam_id' => $this->school_exam_id,
            'student_id' => $this->student_id,
            'theory' => $this->theory,
            'mcq' => $this->mcq,
            'practical' => $this->practical,
            'total' => $totalNumber,
            'grade' => $e->grade,
            'school_id' => school()->id
        ]);
        $this->resetFields();
        $this->alert('success', 'Exam result created.');
    }
    public function edit(SchoolExamResult $schoolExamResult)
    {
        Gate::authorize('school.exam-results.update');
        abort_action($schoolExamResult->school->user_id);
        $this->editable_item = $schoolExamResult;
        $this->class_id = $schoolExamResult->school_class_id;
        $this->student_id = $schoolExamResult->student_id;
        $this->school_exam_id = $schoolExamResult->school_exam_id;
        $this->section_id = $schoolExamResult->school_class_section_id;
        $this->group_id = $schoolExamResult->group_id;
        $this->theory = $schoolExamResult->theory;
        $this->mcq = $schoolExamResult->mcq;
        $this->practical = $schoolExamResult->practical;
        $this->getSection();
        $this->getExams();
        $this->getStudents();
    }
    public function update()
    {
        Gate::authorize('school.exam-results.update');
        abort_action(school()->user_id);
        $this->validate([
            'class_id' => 'required',
            'student_id' => 'required',
            'school_exam_id' => 'required',
            'theory' => 'required',
            'mcq' => 'required',
            'practical' => 'required',
        ]);
        $type = isset($this->group_id) ? 'group' : 'section';
        $result = School::gradingRule(school(), $this->group_id ?? $this->section_id, $type);

        if ($result == null) {
            throw new Exception('This grade doesn\'t have any rule, Please set rule for this.', 203);
        }
        $totalNumber = $this->theory + $this->mcq + $this->practical;
        $e = $result->gradingRules->where('starts_at', '<=', $totalNumber)
            ->where('ends_at', '>=', $totalNumber)
            ->first();

        if ($e == null) {
            throw new Exception('This total number doesn\'t have any rule, Please set rule for this.', 203);
        }
        $this->editable_item->update([
            'school_class_id' => $this->class_id,
            'school_class_section_id' => $this->section_id,
            'group_id' => $this->group_id,
            'school_class_subject_id' => $this->subject_id,
            'school_exam_id' => $this->school_exam_id,
            'student_id' => $this->student_id,
            'theory' => $this->theory,
            'mcq' => $this->mcq,
            'practical' => $this->practical,
            'total' => $totalNumber,
            'grade' => $e->grade,
        ]);
        $this->dispatch('closeModal');
        $this->alert('success', 'Exam result updated');
        $this->resetFields();
    }
    public function destroy(SchoolExamResult $schoolExamResult)
    {
        Gate::authorize('school.exam-results.destroy');
        abort_action($schoolExamResult->school->user_id);
        $schoolExamResult->delete();
        $this->alert('success', 'Exam result deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->theory = null;
        $this->mcq = null;
        $this->practical = null;
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
    public function getSubjectRefresh()
    {
        $this->getSubjects();
        $this->render();
    }
    public function refresh()
    {
        $this->render();
    }
    public function mount()
    {
        Gate::authorize('school.exam-results.index');
    }
    public function render()
    {
        if ($this->filter_class_id != null && $this->filter_section_id && $this->filter_exam_id && $this->filter_subject_id) {
            $results = SchoolExamResult::where('school_class_id', $this->filter_class_id)
                ->where('school_class_section_id', $this->filter_section_id)
                ->where('school_exam_id', $this->filter_exam_id)
                ->where('school_class_subject_id', $this->filter_subject_id)
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
