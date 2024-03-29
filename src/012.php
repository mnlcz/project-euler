<?php

/*
 * The sequence of triangle numbers is generated by adding the natural numbers. 
 * So the 7th triangle number would be: 1 + 2 + 3 + 4 + 5 + 6 + 7 = 28. 
 * The first ten terms would be: 1, 3, 6, 10, 15, 21, 28, 36, 45, 55, ...
 * Let us list the factors of the first seven triangle numbers:
 *      1: 1
 *      3: 1, 3
 *      6: 1, 2, 3, 6
 *      10: 1, 2, 5, 10
 *      15: 1, 3, 5, 15
 *      21: 1, 3, 7, 21
 *      28: 1, 2, 4, 7, 14, 28
 * We can see that 28 is the first triangle number to have over five divisors.
 * What is the value of the first triangle number to have over five hundred divisors?
 */

require 'bootstrap.php';

#region Bruteforce
function brute_force_triangular_number(int $divisors, int $time_limit = 5): int|string
{
    $i = 1;
    $start_time = microtime(true);

    while (true) {
        if ((microtime(true) - $start_time) > $time_limit) {
            return "Execution paused. Time limit of $time_limit seconds exceeded.";
        }

        $triangular_n = ($i * ($i + 1)) / 2;
        $current_divisors = brute_force_count_divisors($triangular_n);

        if ($current_divisors > $divisors) {
            return $triangular_n;
        }

        $i++;
    }
}

function brute_force_count_divisors(int $number): int
{
    $i = 1;
    $divisors = 0;

    while ($i <= $number) {
        if ($number % $i === 0) {
            $divisors++;
        }
        $i++;
    }

    return $divisors;
}
#endregion

#region Optimized
function triangular_number(int $divisors): int
{
    $i = 1;

    while (true) {
        $triangular_n = intdiv($i * ($i + 1), 2);
        $current_divisors = count_divisors($triangular_n);

        if ($current_divisors > $divisors) {
            return $triangular_n;
        }

        $i++;
    }
}

// https://www.mathsisfun.com/prime-factorization.html
function count_divisors(int $num): int
{
    $count = 1;
    $p = 2;

    while ($p * $p <= $num) {
        if ($num % $p === 0) {
            $exp = 0;
            while ($num % $p === 0) {
                $num = intdiv($num, $p);
                $exp++;
            }
            $count *= $exp + 1;
        }
        if ($p === 2) {
            $p = 3;
        } else {
            $p += 2;
        }
    }

    if ($num > 1) {
        $count *= 2;
    }

    return $count;
}
#endregion

echo '[BruteForce] First 📐 number with over 5 divisors: ' . brute_force_triangular_number(5);
echo '[BruteForce] First 📐 number with over 500 divisors: ' . brute_force_triangular_number(500, 10) . PHP_EOL;
echo 'First 📐 number with over 5 divisors: ' . triangular_number(5);
echo 'First 📐 number with over 500 divisors: ' . triangular_number(500);
