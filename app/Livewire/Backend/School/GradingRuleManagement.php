<?php

namespace App\Livewire\Backend\School;

use App\Models\Grade;
use Livewire\Component;
use App\Models\GradingRule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class GradingRuleManagement extends Component
{
    use LivewireAlert;
    public $allRules = [],
        $openCEmodal = false,
        $editable_item,
        $point,
        $grade,
        $starts_at,
        $ends_at,
        $title,
        $e;
    public function rules()
    {
        return [
            'grade' => 'required',
            'point' => 'required',
            'starts_at' => 'required',
            'ends_at' => 'required',
        ];
    }
    public function store()
    {
        Gate::authorize('school.grading-rule.create');
        $this->validate();
        $this->e->gradingRules()->create([
            'grade' => $this->grade,
            'point' => $this->point,
            'starts_at' => $this->starts_at,
            'ends_at' => $this->ends_at,
        ]);
        $this->resetFields();
        $this->alert('success', 'Rule created.');
    }
    public function destroy(GradingRule $gradingRule)
    {
        Gate::authorize('school.grading-rule.destroy');
        $gradingRule->delete();
        $this->alert('success', 'Rule deleted.');
    }
    public function mount($id)
    {
        Gate::authorize('school.grading-rule.index');
        $this->e = Grade::findBySchool($id);
        $this->title = $this->e->grade_name;
        $this->allRules = GradingRule::allRules($id);
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->openCEmodal = false;
        $this->point = null;
        $this->grade = null;
        $this->starts_at = null;
        $this->ends_at = null;
    }
    public function render()
    {
        return view('livewire.backend.school.grading-rule-management')->title($this->title);
    }
}
