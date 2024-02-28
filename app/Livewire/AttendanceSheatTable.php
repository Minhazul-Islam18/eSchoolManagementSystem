<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\Support\Carbon;
use App\Models\StudentAttendance;
use WireUi\View\Components\Checkbox;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AttendanceSheatTable extends PowerGridComponent
{
    use WithExport;
    public $data;
    protected function getListeners()
    {
        return array_merge(
            parent::getListeners(),
            [
                'bulkPresentEvent',
            ]
        );
    }
    public function header(): array
    {
        return [
            Button::add('bulk-present')
                ->slot(__('Submit'))
                ->class('cursor-pointer block bg-indigo-500 text-white px-3 py-1 rounded-md')
                ->dispatch('bulkPresentEvent', [])
        ];
    }

    public function bulkPresentEvent(): void
    {
        if (count($this->checkboxValues) == 0) {
            $this->dispatch('showAlert', ['message' => 'You must select at least one item!']);

            return;
        }

        $this->dispatch('presentSelected', ['ids' => $this->checkboxValues]);
    }


    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('file')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): ?Collection
    {
        return $this->data;
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('Image', function () {
                return `<img src="" width="50px" />`;
            })
            ->addColumn('name_lower', fn (Student $model) => strtolower(e($model->name)))
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Student $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),
            // Column::make('Image', 'student_image'),

            Column::make('Name', 'name_bn')
                ->searchable()
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(\App\Models\Student $row): array
    {
        return [
            // Button::che
            // Checkbox::resolve(['md', 'label'])
            // $this->showCheckBox()
            // Button::add('edit')
            //     ->slot('Edit: ' . $row->id)
            //     ->id()
            //     ->class('pg-btn-white dark:ring-pg-primary-600 dark:border-pg-primary-600 dark:hover:bg-pg-primary-700 dark:ring-offset-pg-primary-800 dark:text-pg-primary-300 dark:bg-pg-primary-700')
            //     ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules(\App\Models\StudentAttendance $row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
