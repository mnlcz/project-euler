<?php

/*
 * 2520 is the smallest number that can be divided by each of the numbers from 1 to 10 without any remainder.
 * What is the smallest positive number that is evenly divisible (divisible with no remainder)
 * by all of the numbers from 1 to 20?
 */

require 'bootstrap.php';

// Works for 1..10. Takes too long for 1..20, added a simple execution time limitation
function my_brute_force_solution(array $boundaries, int $time_limit = 5): int|string
{
    $i = 11;
    $smallest = null;
    extract($boundaries);

    $start_time = microtime(true);

    while (!$smallest) {
        if ((microtime(true) - $start_time) > $time_limit) {
            return "Execution paused. Time limit exceeded.";
        }

        if (evenly_divisible($i, $boundaries)) {
            $smallest = $i;
        }
        $i++;
    }

    return $smallest;
}

// Did some research online for better solutions and ended with this idea...
function optimized_solution(array $boundaries): int
{
    extract($boundaries);
    $lcm = 1;

    for ($i = $min; $i <= $max; $i++) {
        $lcm = gmp_lcm($lcm, $i);
    }

    return (int) $lcm;
}

function evenly_divisible(int $num, array &$boundaries): bool
{
    extract($boundaries);

    return collect()
        ->range($min, $max)
        ->every(fn ($curr) => $num % $curr === 0);
}

$sample_boundaries = ['min' => 1, 'max' => 10];
$real_boundaries = ['min' => 1, 'max' => 20];

echo 'Brute force solution (sample): ' . my_brute_force_solution($sample_boundaries) . PHP_EOL;
echo 'Brute force solution (real): ' . my_brute_force_solution($real_boundaries) . PHP_EOL;
echo 'Optimized solution (sample): ' . optimized_solution($sample_boundaries) . PHP_EOL;
echo 'Optimized solution (real): ' . optimized_solution($real_boundaries);
