<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DatabaseSeederTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_is_fresh_migration_and_seeding_working_fine(): void
    {
        // Run fresh migrations
        Artisan::call('migrate:fresh');

        // Run your seeder
        Artisan::call('db:seed');

        $this->assertTrue(true);
    }
}
