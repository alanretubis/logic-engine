<?php
namespace AlanRetubis\LogicEngine;

use Illuminate\Support\ServiceProvider;
use AlanRetubis\LogicEngine\Registry\OperatorRegistry;
use AlanRetubis\LogicEngine\Registry\ActionRegistry;

class LogicEngineServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load and publish migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Publish config file
        $this->publishes([
            __DIR__.'/../config/logic-engine.php' => config_path('logic-engine.php'),
        ], 'logic-engine-config');

        // Register default operators
        OperatorRegistry::register('==', fn($a, $b) => $a == $b);
        OperatorRegistry::register('!=', fn($a, $b) => $a != $b);
        OperatorRegistry::register('>=', fn($a, $b) => $a >= $b);
        OperatorRegistry::register('<=', fn($a, $b) => $a <= $b);
        OperatorRegistry::register('>', fn($a, $b) => $a > $b);
        OperatorRegistry::register('<', fn($a, $b) => $a < $b);

    }

    public function register()
    {
        // Merge the default config file so users can override it
        $this->mergeConfigFrom(
            __DIR__.'/../config/logic-engine.php',
            'logic-engine'
        );
    }
}
