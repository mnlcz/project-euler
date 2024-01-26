<?php

/*
 * If we list all the natural numbers below 10 that are multiples of 3 or 5, we get 3, 5, 6 and 9.
 * The sum of these multiples is 23.
 * Find the sum of all the multiples of 3 or 5 below 1000.
 */

require 'bootstrap.php';

$sum = collect()->range(1, 999)->filter(fn($n) => $n % 3 === 0 || $n % 5 === 0)->sum();

var_dump($sum);
