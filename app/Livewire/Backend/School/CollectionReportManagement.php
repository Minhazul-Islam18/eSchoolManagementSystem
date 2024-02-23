<?php

namespace App\Livewire\Backend\School;

use App\Models\Student;
use Livewire\Component;
use App\Models\StudentPayment;
use Livewire\Attributes\Computed;
use App\Models\SchoolClassSection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;

class CollectionReportManagement extends Component
{
    use WithPagination;
    use LivewireAlert;
    public $class_id;
    public $section_id;
    public $group_id;
    public $sections = [];
    public $groups = [];
    public $fees = [];
    public $students = [];
    public $payments;
    public $student_id;
    public $fromDate;
    public $toDate;
    public $pagination;
    public $perPage = 5;


    #[Computed()]
    public function classes()
    {
        return school()->classes;
    }

    public function getSection()
    {
        if (null != $this->class_id) {
            $this->sections = SchoolClassSection::where('school_class_id', $this->class_id)->where('school_id', school()->id)->get();
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
        if (null != $this->class_id) {
            $this->groups = school()->classes()->findOrFail($this->class_id)->groups;
        }
    }


    public function getCollectionReport()
    {
        $paginatedData = [];
        // Number of items per page
        $perPage = 5; // Change this as needed
        $column = $this->section_id ? 'school_class_section_id' : 'class_group_id';
        // Fetch the paginated data
        $paginatedData = StudentPayment::whereHas('student', function ($query) use ($column) {
            $query->where('school_class_id', $this->class_id)
                ->where($column, $this->section_id ?? $this->group_id);
        })
            ->whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->with([
                'fee', 'student', 'studentClass', 'studentClassSection', 'studentClassGroup'
            ])
            ->paginate($perPage);

        // Convert the paginated data to a regular collection
        $this->payments = json_encode($paginatedData);

        // // Create a paginator instance for rendering pagination links in the Blade view
        // $paginator = $paginatedData->links();

        // // Pass the paginator links to the view for rendering pagination links
        // $this->pagination = json_encode($paginator);

        // dd($this->payments);
    }

    public function render()
    {
        $paginatedData = [];
        // Number of items per page
        $perPage = 5; // Change this as needed
        $row = $this->section_id ? 'school_class_section_id' : 'class_group_id';
        // Fetch the paginated data
        $paginatedData = StudentPayment::whereHas('student', function ($query) use ($row) {
            $query->where('school_class_id', $this->class_id)
                ->where($row, $this->section_id ?? $this->group_id);
        })
            ->whereBetween('created_at', [$this->fromDate, $this->toDate])
            ->with([
                'fee', 'student', 'studentClass', 'studentClassSection', 'studentClassGroup'
            ])
            ->get();

        return view('livewire.backend.school.collection-report-management', ['paginatedData' => $paginatedData])
            ->title('Collection report generate');
    }
}
