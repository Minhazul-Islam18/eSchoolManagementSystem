<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Backend\RoleManagement;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CheckRoleActionsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    // public function test_check_is_role_create(): void
    // {
    //     $user = User::role()->where('slug', 'super_admin')->first();
    //     $permission = Permission::factory()->create();

    //     $role = Role::create([
    //         'name' => 'Test',
    //         'slug' => 'test',
    //     ])->permissions()->sync($permission->id, []);

    //     Livewire::actingAs($user)
    //         ->test(RoleManagement::class)
    //         ->set($role)
    //         ->call('StoreRole', $user)
    //         ->assertSee();
    // }


    public function test_check_is_role_create(): void
    {
        $user = User::create([
            'name' => 'test name',
            'email' => 'test@gmaol.com',
            'email_verified_at' => now(),
            'password' => 'password', // password
        ]);
        $permission = Permission::create([
            'id' => 1,
            'name' => 'Test',
            'slug' => 'test'
        ]);

        Livewire::actingAs($user)
            ->test(RoleManagement::class)
            ->set('role_name', 'Test') // Set the role name
            ->set('permissions', [$permission->id]) // Set permissions as an array
            ->call('StoreRole', $user)
            ->assertSee('Role Created Successfully'); // Specify the text to check for
    }
}
