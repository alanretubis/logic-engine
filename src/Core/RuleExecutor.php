<?php
namespace AlanRetubis\LogicEngine\Core;

use AlanRetubis\LogicEngine\Registry\ActionRegistry;
use AlanRetubis\LogicEngine\Registry\OperatorRegistry;

class RuleExecutor
{
    /**
     * Executes a parsed rule (conditions + actions) based on context data
     */
    public function execute(array $parsedRule, array $context)
    {
        // Check if all conditions are true
        foreach ($parsedRule['conditions'] as $condition) {
            $value = data_get($context, $condition['field']); // Get field from context
            $expected = $condition['value'];
            $operator = $condition['operator'];

            // Get registered operator function (e.g. "==", ">=")
            $evaluator = OperatorRegistry::get($operator);

            // If condition fails, stop execution
            if (!$evaluator($value, $expected)) {
                return false;
            }
        }

        // If all conditions pass, perform each action
        foreach ($parsedRule['actions'] as $action) {
            $handler = ActionRegistry::get($action['name']); // e.g. SendEmailAction
            $handler->handle($action['params'], $context);
        }

        return true;
    }
}
