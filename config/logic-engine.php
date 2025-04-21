<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Logic Engine Configuration
    |--------------------------------------------------------------------------
    |
    | This file is for storing the configuration options for the Logic Engine
    | package. You can define default logic namespaces, models, action/condition
    | registries, or even toggle features.
    |
    */

    // Namespace for user-defined actions and conditions (optional override)
    'namespaces' => [
        'actions'    => 'App\\LogicEngine\\Actions',
        'conditions' => 'App\\LogicEngine\\Conditions',
    ],

    // Enable logging of executed rules (for audit/debug)
    'logging' => true,

    // Default model classes used by the logic engine
    'models' => [
        'rule'       => \AlanRetubis\LogicEngine\Models\Rule::class,
        'condition'  => \AlanRetubis\LogicEngine\Models\Condition::class,
        'action'     => \AlanRetubis\LogicEngine\Models\Action::class,
    ],

    // Database table names (optional override)
    'table_names' => [
        'rules'      => 'logic_engine_rules',
        'conditions' => 'logic_engine_conditions',
        'actions'    => 'logic_engine_actions',
    ],

    // Register built-in conditions/actions
    'register_defaults' => true,
];
