<?php

declare(strict_types=1);

namespace Zeggriim\FizzBuzz\Tests;

use Generator;
use PHPUnit\Framework\TestCase;
use Zeggriim\FizzBuzz\Fizzbuzz;
use Zeggriim\FizzBuzz\Rule;

class FizzbuzzTest extends TestCase
{
    /**
     * @dataProvider providerIteration1
     * @param int $input
     * @param string $result
     * @return void
     */
    public function testIteration1(int $input, string $result): void
    {
        $fizzbuzz = new Fizzbuzz(
            new Rule(static fn(int $input): bool => $input % 3 === 0, 'Fizz'),
            new Rule(static fn(int $input): bool => $input % 5 === 0, 'Buzz')
        );
        self::assertSame($result, $fizzbuzz($input));
    }

    /**
     * @dataProvider providerIteration2
     * @param int $input
     * @param string $result
     * @return void
     */
    public function testIteration2(int $input, string $result): void
    {
        $fizzbuzz = new Fizzbuzz(
            new Rule(static fn(int $input): bool => $input % 7 === 0, 'Fizz'),
            new Rule(static fn(int $input): bool => $input % 11 === 0, 'Buzz')
        );
        self::assertSame($result, $fizzbuzz->__invoke($input));
    }

    /**
     * @dataProvider providerIteration3
     * @param int $input
     * @param string $result
     * @return void
     */
    public function testIteration3(int $input, string $result): void
    {
        $fizzbuzz = new Fizzbuzz(
            new Rule(static fn(int $input): bool => $input % 13 === 0, 'Fizz'),
            new Rule(static fn(int $input): bool => $input % 17 === 0, 'Buzz'),
            new Rule(static fn(int $input): bool => $input % 19 === 0, 'Fuzz'),
            new Rule(static fn(int $input): bool => $input % 23 === 0, 'Bizz')
        );
        self::assertSame($result, $fizzbuzz->__invoke($input));
    }

    /**
     * @dataProvider providerIteration4
     * @param int $input
     * @param string $result
     * @return void
     */
    public function testIteration4(int $input, string $result): void
    {

        $fizzBuzz = new Fizzbuzz(
            new Rule(static fn(int $input): bool => $input % 3 !== 0, 'Fizz'),
            new Rule(static fn(int $input): bool => $input % 2 !== 0, 'Buzz'),
            new Rule(static fn(int $input): bool => fmod(sqrt($input),1) == 0, 'Fuzz')
        );
        self::assertSame($result, $fizzBuzz->__invoke($input));
    }

    public function providerIteration1(): Generator
    {
        yield [1, '1'];
        yield [2, '2'];
        yield [3, 'Fizz'];
        yield [4, '4'];
        yield [6, 'Fizz'];
        yield [5, 'Buzz'];
        yield [10, 'Buzz'];
        yield [15, 'FizzBuzz'];
        yield [30, 'FizzBuzz'];
    }

    public function providerIteration2(): Generator
    {
        yield [1, '1'];
        yield [2, '2'];
        yield [7, 'Fizz'];
        yield [11, 'Buzz'];
        yield [77, 'FizzBuzz'];
    }

    public function providerIteration3(): Generator
    {
        yield [1, '1'];
        yield [2, '2'];
        yield [13, 'Fizz'];
        yield [17, 'Buzz'];
        yield [19, 'Fuzz'];
        yield [23, 'Bizz'];
        yield [13*17, 'FizzBuzz'];
        yield [13*19, 'FizzFuzz'];
        yield [13*23, 'FizzBizz'];
        yield [17*19, 'BuzzFuzz'];
        yield [17*23, 'BuzzBizz'];
        yield [19*23, 'FuzzBizz'];
        yield [13*17*19, 'FizzBuzzFuzz'];
        yield [13*17*23, 'FizzBuzzBizz'];
        yield [13*19*23, 'FizzFuzzBizz'];
        yield [17*19*23, 'BuzzFuzzBizz'];
        yield [13*17*19*23, 'FizzBuzzFuzzBizz'];
     }

    public function providerIteration4(): Generator
    {
        yield [1, 'FizzBuzzFuzz'];
        yield [2, 'Fizz'];
        yield [3, 'Buzz'];
        yield [6, '6'];
        yield [4, 'FizzFuzz'];
        yield [9, 'BuzzFuzz'];
        yield [16, 'FizzFuzz'];
        yield [49, 'FizzBuzzFuzz'];
        yield [7, 'FizzBuzz'];
    }
}