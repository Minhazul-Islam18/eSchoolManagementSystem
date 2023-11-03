<?php

namespace App\Livewire\Backend;

use App\Models\Menu;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Gate;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class MenuManagement extends Component
{
    use LivewireAlert;
    #[Title('Menu management')]
    public $editable_menu =  false;
    public $OpenEditModal = false;
    public $name = '';
    public $id = null;
    public $description = '';
    public function rules()
    {
        return [
            'name' => 'required|unique:menus'
        ];
    }
    public function store()
    {
        Gate::authorize('app.menus.create');
        $this->validate();
        Menu::create([
            'name' => Str::slug($this->name),
            'description' => $this->description,
        ]);
        $this->OpenEditModal = false;
        $this->dispatch('closeModal');
        $this->ResetFields();
        $this->alert('success', 'Menu Created');
    }
    public function edit(Menu $menu)
    {
        Gate::authorize('app.menus.edit');
        $this->id = $menu->id;
        $this->name = $menu->name;
        $this->description = $menu->description;
        $this->editable_menu = true;
    }
    public function update()
    {
        Gate::authorize('app.menus.edit');
        $this->validate([
            'name' => 'required|unique:menus,name,' . $this->id,
        ]);
        $menuI = Menu::findOrFail($this->id);
        $menuI->update([
            'name' => Str::slug($this->name),
            'description' => $this->description,
        ]);
        $this->OpenEditModal = false;
        $this->dispatch('closeModal');
        $this->ResetFields();
        $this->alert('success', 'Menu Updated');
    }
    public function destroy(Menu $menu)
    {
        Gate::authorize('app.menus.destroy');
        if ($menu->is_deletable == 1) {
            $menu->delete();
            $this->ResetFields();
            $this->alert('success', 'Menu Deleted');
        }
    }
    public function ResetFields()
    {
        $this->id = null;
        $this->name = null;
        $this->description = null;
        $this->editable_menu = false;
    }
    public function mount()
    {
        Gate::authorize('app.menus.index');
    }
    public function render()
    {
        $menus = Menu::all();
        return view('livewire.backend.menu-management', ['menus' => $menus]);
    }
}
