<?php
namespace AlanRetubis\LogicEngine\Registry;

class OperatorRegistry
{
    protected static array $operators = [];

    /**
     * Register a custom operator and its logic
     */
    public static function register(string $symbol, callable $callback)
    {
        static::$operators[$symbol] = $callback;
    }

    /**
     * Get the logic function for a specific operator
     */
    public static function get(string $symbol): ?callable
    {
        return static::$operators[$symbol] ?? null;
    }
}
