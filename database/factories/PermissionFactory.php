<?php

namespace Database\Factories;

use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker('name');
        return [
            Permission::create([
                'name' => 'Dashboard' . $name,
                'slug' => 'app.' . $name,
                'deletable' => false
            ]),
        ];
    }
}
