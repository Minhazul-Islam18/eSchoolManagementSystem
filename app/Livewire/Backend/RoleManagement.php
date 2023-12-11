<?php

namespace App\Livewire\Backend;

use App\Models\Role;
use App\Models\User;
use App\Models\Module;
use GuzzleHttp\Client;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Http;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RoleManagement extends Component
{
    use LivewireAlert;
    use AuthorizesRequests;
    public $editable_role;
    public $AllModules;
    public $role_name;
    public $permissions = [];
    public $ConfirmDelete = false;
    public $permissions_for_role;
    public $deletable_role;
    #[Title('Role Management')]
    #[Layout('layouts.backend.admin.layout')]
    public function CreateRole(User $user)
    {
        $this->authorize('app.roles.create', $user);
        $this->resetFields();
        $this->AllModules =  Module::all();
    }
    public function StoreRole(User $user)
    {
        $this->authorize('app.roles.create', $user);
        //validate
        $this->validate([
            'role_name' => 'required|unique:roles,name',
            'permissions' => 'required|array'
        ]);
        //create
        Role::create([
            'name' => $this->role_name,
            'slug' => Str::slug($this->role_name)
        ])->permissions()->sync(array_keys($this->permissions), []);
        //alert
        $this->alert('success', 'Role Created Successfully!');
        //reset
        $this->resetFields();
        //dispatch an event
        $this->dispatch('table-updated');
    }
    public function EditRole(Role $role)
    {
        $this->authorize('app.roles.edit', auth()->user());
        //set to empty
        $this->permissions = [];
        //get the role which gonna be edit and set those data fields.
        $this->editable_role = $role;
        $this->role_name = $role->name;
        foreach ($role->permissions as $key => $value) {
            $this->permissions[] = $value->id;
        }
        $this->AllModules =  Module::all();
        $this->permissions = array_fill_keys($this->permissions, true);
    }
    public function UpdateRole(User $user)
    {
        $this->authorize('app.roles.edit', $user);
        //validate
        $this->validate([
            'role_name' => 'required',
            'permissions' => 'nullable|array'
        ]);
        //Update
        $this->editable_role->update([
            'name' => $this->role_name,
            'slug' => Str::slug($this->role_name)
        ]);
        $r = $this->editable_role->permissions()->sync(array_keys($this->permissions), []);
        //alert
        $this->alert('success', 'Role updated Successfully!');
        //reset
        $this->resetFields();
        //dispatch an event
        $this->dispatch('table-updated');
    }
    public function DeleteConfirmation($id)
    {
        $this->ConfirmDelete  = true;
        $this->deletable_role = $id;
    }
    public function DeleteRole(User $user)
    {
        $this->authorize('app.roles.destroy', $user);
        if ($this->ConfirmDelete) {
            $this->deletable_role =  Role::findOrFail($this->deletable_role);
            $this->deletable_role->delete();
        }
        //alert
        $this->alert('success', 'Role updated Successfully!');
        //reset
        $this->resetFields();
        //dispatch an event
        $this->dispatch('table-updated');
    }
    public function resetFields()
    {
        $this->role_name = null;
        $this->permissions = [];
        $this->AllModules =  null;
        $this->editable_role =  null;
    }
    public function mount(User $user)
    {
        $this->authorize('app.roles.index', $user);
    }
    public function render()
    {
        $this->dispatch('table-updated');
        $roles = Role::with('permissions')->get();
        return view('livewire.backend.role-management')->with('roles', $roles);
    }
}
