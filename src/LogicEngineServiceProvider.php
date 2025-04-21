<?php
namespace AlanRetubis\LogicEngine;

use Illuminate\Support\ServiceProvider;
use AlanRetubis\LogicEngine\Registry\OperatorRegistry;
use AlanRetubis\LogicEngine\Actions\SendEmailAction;
use AlanRetubis\LogicEngine\Registry\ActionRegistry;

class LogicEngineServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Publish migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // Register default operators
        OperatorRegistry::register('==', fn($a, $b) => $a == $b);
        OperatorRegistry::register('!=', fn($a, $b) => $a != $b);
        OperatorRegistry::register('>=', fn($a, $b) => $a >= $b);
        OperatorRegistry::register('<=', fn($a, $b) => $a <= $b);
        OperatorRegistry::register('>', fn($a, $b) => $a > $b);
        OperatorRegistry::register('<', fn($a, $b) => $a < $b);

        // Register default actions
        ActionRegistry::register('SendEmail', SendEmailAction::class);
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/logic-engine.php', 'logic-engine');
    }
}
