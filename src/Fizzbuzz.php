<?php

declare(strict_types=1);

namespace Zeggriim\FizzBuzz;

final class Fizzbuzz
{

    /**
     * @var array<array-key, Rule>
     */
    private array $rules;

    public function __construct(Rule ...$rules)
    {
        $this->rules = $rules;
    }

    public function __invoke(int $input): string
    {
        $result = "";

        foreach ($this->rules as $rule){
            if ($rule->match($input)) {
                $result .= $rule->result;
            }
        }

        return $result === '' ? (string) $input : $result;
    }
}