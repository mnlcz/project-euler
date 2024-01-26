<?php

/*
 * The sum of the squares of the first ten natural numbers is:
 *      1^2 + 2^2 + ... + 10^2 = 385
 * The square of the sum of the first ten natural numbers is:
 *      (1 + 2 + ... + 10)^2 = 55^2 = 3025
 * The difference between the sum of the squares of the first ten natural numbers and the square of the sum is:
 *      3025 - 385 = 2640
 * Find the difference between the sum of the squares of the first one hundred natural numbers and the square of the sum.
 */

require 'bootstrap.php';

use Illuminate\Support\Collection;

function solve(Collection $range): int
{
    return square_of_sum($range) - sum_of_squares($range);
}

function sum_of_squares(Collection $range): int
{
    return $range->reduce(fn($carry, $item) => $carry + $item ** 2, 0);
}

function square_of_sum(Collection $range): int
{
    return $range->sum() ** 2;
}

$sample_range = collect()->range(1, 10);
$real_range = collect()->range(1, 100);

var_dump(solve($sample_range));
var_dump(solve($real_range));
