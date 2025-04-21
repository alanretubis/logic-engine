<?php
namespace AlanRetubis\LogicEngine\Core;

class RuleParser
{
    /**
     * Parses a pseudocode script into structured conditions and actions.
     */
    public function parse(string $script): array
    {
        // Split script into "WHEN ... THEN ..." parts
        [$when, $then] = explode('THEN', $script);

        // Remove "WHEN" and split by "AND" for multiple conditions
        $when = trim(str_replace('WHEN', '', $when));
        $conditions = array_map('trim', explode('AND', $when));

        // Split actions (also joined with AND)
        $actions = array_map('trim', explode('AND', trim($then)));

        return [
            'conditions' => array_map([$this, 'parseCondition'], $conditions),
            'actions' => array_map([$this, 'parseAction'], $actions),
        ];
    }

    /**
     * Parses a single condition like `age >= 18`
     */
    protected function parseCondition(string $condition)
    {
        preg_match('/(.+?)(==|!=|>=|<=|>|<)(.+)/', $condition, $matches);
        return [
            'field' => trim($matches[1]),        // e.g. 'age'
            'operator' => trim($matches[2]),     // e.g. '>='
            'value' => trim($matches[3], " '\"") // e.g. '18'
        ];
    }

    /**
     * Parses a single action like `SendEmail(to: guardian.email)`
     */
    protected function parseAction(string $action)
    {
        preg_match('/(\w+)\((.*?)\)/', $action, $matches);
        $params = [];

        // If the action has parameters, split and parse them
        if (!empty($matches[2])) {
            foreach (explode(',', $matches[2]) as $param) {
                [$key, $val] = explode(':', $param);
                $params[trim($key)] = trim($val, " '\"");
            }
        }

        return [
            'name' => $matches[1],   // e.g. 'SendEmail'
            'params' => $params,     // e.g. ['to' => 'guardian.email']
        ];
    }
}
