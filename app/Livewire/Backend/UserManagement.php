<?php

namespace App\Livewire\Backend;

use App\Models\Role;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rules\Password;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserManagement extends Component
{
    use LivewireAlert;
    use AuthorizesRequests;
    #[Title('Users')]
    public $editable_user;
    public $all_roles;
    public $OpenEditModal = false;
    public $user = [
        'id' => null,
        'name' => '',
        'role' => null,
        'email' => '',
        'password' => '',
        'status' => false
    ];
    public $preview_user;
    public function rules()
    {
        return [
            'user.name' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email',
            'user.password' => 'required|confirmed',
            'user.password_confirmation' => 'required|same:user.password',
        ];
    }
    public $deletable_user;
    #[Layout('layouts.backend.admin.layout')]
    public function store()
    {
        Gate::authorize('app.users.create');
        $this->validate();
        User::create([
            'name' => $this->user['name'],
            'role_id' => $this->user['role'],
            'email' => $this->user['email'],
            'password' => $this->user['password'],
            'status' => (bool)$this->user['status'],
        ]);
        $this->OpenEditModal = false;
        $this->dispatch('closeModal');
        $this->alert('success', 'User Created Successfully!');
        $this->ResetFields();
    }
    public function view(User $user)
    {
        Gate::authorize('app.users.show');
        $this->preview_user = $user;
    }
    public function edit(User $user)
    {
        Gate::authorize('app.users.edit');
        $this->user['id'] = $user->id;
        $this->user['name'] = $user->name;
        $this->user['email'] = $user->email;
        $this->user['status'] = $user->status == 1 ? true : false;
        $this->user['role'] = $user->role_id;
        $this->editable_user = true;
        $this->all_roles = Role::all();
        // dd($this->user['status']);
    }
    public function update()
    {
        Gate::authorize('app.users.update');
        $this->validate([
            'user.name' => 'required|min:3',
            'user.email' => 'required|email|unique:users,email,' . $this->user['id'],
            'user.password' => 'nullable|confirmed',
            'user.password_confirmation' => 'nullable|same:user.password',
        ]);
        $user =  User::findOrFail($this->user['id']);
        $user->update([
            'name' => $this->user['name'],
            'role_id' => $this->user['role'],
            'email' => $this->user['email'],
            'password' => $this->user['password'],
            'status' => (bool)$this->user['status'],
        ]);
        $this->ResetFields();
        $this->OpenEditModal = false;
        $this->dispatch('closeModal');
        $this->alert('success', 'User Updated Successfully!');
    }
    public function delete(User $user)
    {
        Gate::authorize('app.users.destroy');
        $user->delete();
        $this->alert('success', 'User Deleted Successfully!');
    }
    public function getAllRoles()
    {
        $this->all_roles = Role::all();
    }
    public function ResetFields()
    {
        $this->editable_user = null;
        $this->user = [
            'id' => '',
            'name' => '',
            'role' => null,
            'email' => '',
            'password' => '',
            'status' => true
        ];
    }
    public function mount()
    {
        Gate::authorize('app.users.index');
    }
    public function render()
    {
        $users = User::all();
        return view('livewire.backend.user-management', ['users' => $users]);
    }
}
