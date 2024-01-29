<?php

/*
 * A Pythagorean triplet is a set of three natural numbers, a < b < c, for which:
 *      a^2 + b^2 = c^2
 * For example: 3^2 + 4^2 = 9 + 16 = 25 = 5^2
 * There exists exactly one Pythagorean triplet for which a + b + c = 1000. Find the product abc.
 */

require 'bootstrap.php';

use Illuminate\Support\Collection;

function solve(): int
{
    return find_special_triplet()->reduce(fn ($x, $y) => $x * $y, 1);
}

function find_special_triplet(): Collection
{
    $n = 1;
    $m = 2;
    while ($n < 999) {
        $triplet = pythagorean_triplet($n, $m);
        while ($m < 1000) {
            if ($triplet->sum() === 1000) {
                return $triplet;
            }
            $m++;
            $triplet = pythagorean_triplet($n, $m);
        }
        $n++;
        $m = $n + 1;
    }

    return new Collection;
}

// $n < $m
function pythagorean_triplet(int $n, int $m): Collection
{
    $a = $m ** 2 - $n ** 2;
    $b = 2 * $m * $n;
    $c = $m ** 2 + $n ** 2;

    return collect(compact('a', 'b', 'c'));
}

echo 'Product of special triplet abc: ' . solve();
