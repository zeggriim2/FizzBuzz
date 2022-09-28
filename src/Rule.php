<?php

declare(strict_types=1);

namespace Zeggriim\FizzBuzz;

use Closure;

final class Rule
{

    public function  __construct(public closure $callable, public string $result)
    {
    }

    public function match(int $input): bool
    {
        return call_user_func_array($this->callable, [$input]);
    }
}