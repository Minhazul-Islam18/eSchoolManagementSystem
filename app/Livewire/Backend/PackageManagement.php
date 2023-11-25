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
    public $additional_features;
    public $student_allowed;
    public $price;
    #[Validate('required|max:50|min:1|unique:packages,name', as: 'Package name')]
    public $package_name;
    public $packages = [];
    public $openCEmodal = false;
    #[Title('Package Management')]
    #[Layout('layouts.backend.admin.layout')]
    public function rules()
    {
        return [
            'package_name' => [
                Rule::unique('packages')->ignore($this->editable_item),
            ],
        ];
    }
    public function store()
    {
        $this->validate();
        Package::create([
            'name' => $this->package_name,
            'student_allowed' => $this->student_allowed,
            'price' => $this->price,
            'additional_features' => $this->additional_features,
        ]);

        $this->alert('success', 'Package created.');
    }
    public function render()
    {
        return view('livewire.backend.package-management');
    }
}
