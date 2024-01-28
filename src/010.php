<?php

/*
 * The sum of the primes below 10 is 2 + 3 + 5 + 7 = 17.
 * Find the sum of all the primes below two million.
 */

require 'bootstrap.php';

use Illuminate\Support\Collection;

function solve(int $limit) : int
{
    return sieve_of_eratosthenes($limit)->sum();
}

// https://en.wikipedia.org/wiki/Sieve_of_Eratosthenes
function sieve_of_eratosthenes(int $limit) : Collection
{
    // Step 1: fill the collection, assume every number is prime
    $primes = collect(array_fill(2, $limit - 1, true));

    // Step 2: start from the first prime (2)
    // Iterate only up to the square root of the limit, as beyond that all non-primes would have been already marked
    for ($p = 2; $p * $p <= $limit; $p++) {
        // If $p is a prime (not marked as non-prime), proceed to mark its multiples
        if ($primes[$p]) {
            // Step 3: mark all multiples of $p as non-prime
            // Start from $p * $p, as smaller multiples of $p would have been marked by smaller primes
            for ($i = $p * $p; $i <= $limit; $i += $p) {
                $primes[$i] = false;
            }
        }
    }

    // Step 4: collect all primes
    $primes = $primes->filter(fn ($p) => $p)->keys();

    return $primes;
}

echo 'Sum of primes below 10: ' . solve(10);
echo 'Sum of primes below 2mill: ' . solve(2_000_000);
