<?php

/*
 * The prime factors of 13195 are 5, 7, 13 and 29.
 * What is the largest prime factor of the number 600851475143?
 */

require 'bootstrap.php';

$use_sample = false;
$num = $use_sample ? 13_195 : 600_851_475_143;
$prime = 2;

while ($prime < $num) {
    while ($num % $prime === 0) {
        $num = intdiv($num, $prime);
    }
    $prime++;
}

var_dump($prime);
