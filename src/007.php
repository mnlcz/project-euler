<?php

/*
 * By listing the first six prime numbers: 2, 3, 5, 7, 11, and 13
 * We can see that the 6th prime is 13.
 * What is the 10001st prime number?
 */

require 'bootstrap.php';

function nth_prime(int $nth): int
{
    return take_n_primes($nth)->last();
}

function take_n_primes(int $n): Illuminate\Support\Collection
{
    $i = 2;
    $primes = collect();

    while ($primes->count() < $n) {
        if (gmp_prob_prime($i) === 2) {
            $primes->add($i);
        }
        $i++;
    }

    return $primes;
}

echo '6th prime number: ' . nth_prime(6) . PHP_EOL;
echo '1001th prime number: ' . nth_prime(10_001);
