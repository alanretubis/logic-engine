<?php
namespace AlanRetubis\LogicEngine\Registry;

class ActionRegistry
{
    protected static array $actions = [];

    /**
     * Register a custom action handler class
     */
    public static function register(string $name, string $class)
    {
        static::$actions[$name] = new $class;
    }

    /**
     * Get the registered action instance
     */
    public static function get(string $name)
    {
        return static::$actions[$name] ?? null;
    }
}
