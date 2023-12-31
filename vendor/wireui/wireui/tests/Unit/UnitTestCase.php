<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\Concerns\InteractsWithViews;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase;
use ReflectionClass;
use WireUi\Providers\WireUiServiceProvider;

class UnitTestCase extends TestCase
{
    use InteractsWithViews;

    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function defineWebRoutes($router)
    {
        base_path('src/routes/web.php');
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            WireUiServiceProvider::class,
        ];
    }

    /** Call protected/private method of a class */
    public function invokeMethod(mixed $object, string $method, array $parameters = [])
    {
        $reflection = new ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($method);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
