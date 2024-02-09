<?php

namespace App\Livewire\Backend\School;

use Livewire\Component;
use App\Models\SchoolClass;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use App\Models\SchoolFeeCategory;
use App\Models\SchoolClassSection;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class FeeCategoryManagement extends Component
{
    use LivewireAlert;
    #[Title('Fee categories')]
    public $editable_item, $category_name, $category_slug, $openCEmodal = false;
    public function rules()
    {
        return [
            'category_name' => 'required|min:1|max:50',
            'category_slug' => 'nullable|min:1|max:50',
        ];
    }
    public function store()
    {
        Gate::authorize('school.fees.create');
        $this->validate();
        SchoolFeeCategory::create([
            'school_id' => school()->id,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug ?? Str::slug($this->category_name)
        ]);
        $this->alert('success', 'Category added.');
        $this->resetFields();
    }
    public function edit(SchoolFeeCategory $schoolFeeCategory)
    {
        Gate::authorize('school.fees.update');
        $this->editable_item = $schoolFeeCategory;
        $this->category_name = $schoolFeeCategory->category_name;
        $this->category_slug = $schoolFeeCategory->category_slug;
    }
    public function update()
    {
        Gate::authorize('school.fees.update');
        $this->validate();
        $e = SchoolFeeCategory::findOrFail($this->editable_item->id);
        $e->update([
            'school_id' => school()->id,
            'category_name' => $this->category_name,
            'category_slug' => $this->category_slug ?? Str::slug($this->category_name)
        ]);
        $this->alert('success', 'Category updated.');
        $this->resetFields();
    }
    public function destroy(SchoolFeeCategory $schoolFeeCategory)
    {
        Gate::authorize('school.fees.destroy');
        abort_action($schoolFeeCategory->school->user_id);
        $schoolFeeCategory->delete();
        $this->alert('success', 'Fee category deleted');
        $this->resetFields();
    }
    public function resetFields()
    {
        $this->editable_item = null;
        $this->category_name = null;
        $this->category_slug = null;
        $this->openCEmodal = false;
    }
    public function render()
    {
        $categories = SchoolFeeCategory::allCategories();
        $classes = SchoolClass::allClasses();
        return view('livewire.backend.school.fee-category-management')->with([
            'categories' => $categories,
            'classes' => $classes,
        ]);
    }
}
