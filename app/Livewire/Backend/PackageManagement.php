<?php

namespace App\Livewire\Backend;

use App\Models\Package;
use Livewire\Component;
use Livewire\Attributes\Title;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PackageManagement extends Component
{
    use LivewireAlert;
    use AuthorizesRequests;
    public $editable_item;
    public ?Package $package;
    public $additional_features;
    public $student_allowed;
    public $price;
    public $status;
    #[Validate('required|max:50|min:1', as: 'Package name')]
    public $package_name;
    public $openCEmodal = false;

    #[Title('Package Management')]
    #[Layout('layouts.backend.admin.layout')]

    public function rules()
    {
        return [
            'package_name' => 'unique:packages,name,id:' . $this->editable_item?->id,
        ];
    }

    public function store()
    {
        Package::create([
            'name' => $this->package_name,
            'allowed_students' => $this->student_allowed,
            'price' => $this->price,
            'additional_features' => $this->additional_features,
            'status' => $this->status,
        ]);

        $this->resetFields();
        $this->alert('success', 'Package created.');
    }

    public function show(Package $package)
    {
        $this->editable_item = $package;
        $this->package = $package;
        $this->package_name = $this->editable_item->name;
        $this->student_allowed = $this->editable_item->allowed_students;
        $this->price = $this->editable_item->price;
        $this->additional_features = $this->editable_item->additional_features;
        $this->status = $this->editable_item->status;
    }

    public function edit(Package $package)
    {
        $this->editable_item = $package;
        $this->package = $package;
        $this->package_name = $this->editable_item->name;
        $this->student_allowed = $this->editable_item->allowed_students;
        $this->price = $this->editable_item->price;
        $this->additional_features = $this->editable_item->additional_features;
        $this->status = $this->editable_item->status;
    }

    public function update()
    {
        $this->validate();

        $this->editable_item->update([
            'name' => $this->package_name,
            'allowed_students' => $this->student_allowed,
            'price' => $this->price,
            'additional_features' => $this->additional_features,
            'status' => $this->status,
        ]);

        $this->resetFields();
        $this->alert('success', 'Package updated.');
    }

    public function destroy(Package $package)
    {
        $package->delete();

        $this->alert('success', 'Package deleted');
    }

    public function resetFields()
    {
        $this->editable_item = null;
        $this->package = null;
        $this->additional_features = null;
        $this->student_allowed = null;
        $this->price = null;
        $this->package_name = null;
        $this->status = null;
        $this->openCEmodal =  false;
    }

    public function render()
    {
        $packages = Package::all();
        return view('livewire.backend.package-management', ['packages' => $packages]);
    }
}
