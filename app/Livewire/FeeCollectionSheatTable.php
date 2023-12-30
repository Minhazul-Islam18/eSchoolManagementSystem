<?php

namespace App\Livewire;

use App\Models\Student;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\PowerGridColumns;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class FeeCollectionSheatTable extends PowerGridComponent
{
    use WithExport;
    public $data;
    public function datasource(): ?Collection
    {
        // dd($this->data);
        return $this->data;
    }
    // protected function getListeners()
    // {
    //     return array_merge(
    //         parent::getListeners(),
    //         [
    //             // 'pg:eventRefresh-' .  $this->tableName  => '$refresh',
    //         ]
    //     );
    // }
    // public function header(): array
    // {
    //     return [
    //         // Button::add('bulk-present')
    //         //     ->slot(__('Present all'))
    //         //     ->class('cursor-pointer block bg-indigo-500 text-white px-3 py-1 rounded-md')
    //         //     ->dispatch('bulkPresentEvent', [])
    //     ];
    // }

    // public function bulkPresentEvent(): void
    // {
    //     if (count($this->checkboxValues) == 0) {
    //         $this->dispatch('showAlert', ['message' => 'You must select at least one item!']);

    //         return;
    //     }

    //     $this->dispatch('presentSelected', ['ids' => $this->checkboxValues]);
    // }
    // #[On('reload-table')]
    // public function reloadTable()
    // {
    //     $this->fillData();
    // }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            // Responsive::make(),
            Exportable::make('file')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function addColumns(): PowerGridColumns
    {
        return PowerGrid::columns()
            ->addColumn('id')
            ->addColumn('name')
            ->addColumn('created_at_formatted', function ($entry) {
                return Carbon::parse($entry->created_at)->format('d/m/Y');
            });
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'name_bn')
                ->searchable()
                ->sortable(),

            Column::make('Created', 'created_at_formatted'),

            Column::action('Action')
        ];
    }

    // public function actions(Student $row): array
    // {
    //     return [
    //         Button::add('edit-fee')
    //             ->slot('Edit')
    //             ->class('bg-indigo-500 text-white px-4 py-2 rounded')
    //             ->dispatch('student', ['id' => $row])
    //             ->openModal('student-fee-collection-modal', ['fees' => $row->fees])
    //             ->tooltip('Edit Record'),

    //     ];
    // }
}
