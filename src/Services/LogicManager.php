<?php
namespace AlanRetubis\LogicEngine\Services;

use AlanRetubis\LogicEngine\Models\LogicRule;
use AlanRetubis\LogicEngine\Core\RuleParser;
use AlanRetubis\LogicEngine\Core\RuleExecutor;

class LogicManager
{
    /**
     * Main entry point to trigger rules for a given event
     */
    public function trigger(string $eventKey, array $context = [])
    {
        // Load all active rules for this event trigger
        $rules = LogicRule::where('trigger', $eventKey)->where('enabled', true)->get();

        $parser = new RuleParser();
        $executor = new RuleExecutor();

        foreach ($rules as $rule) {
            // Parse and execute each rule using context data
            $parsed = $parser->parse($rule->raw_script);
            $executor->execute($parsed, $context);
        }
    }
}
