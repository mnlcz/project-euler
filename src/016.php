<?php

/*
 * 2^15 = 32768 and the sum of its digits is 3 + 2 + 7 + 6 + 8 = 26
 * What is the sum of the digits of the number 2^1000?
 */

require 'bootstrap.php';

use Brick\Math\BigInteger;

function sum_of_digits(int $num, int $exponent): int
{
    $chars = str_split(BigInteger::of($num)->power($exponent)->__toString());
    $sum = 0;

    foreach ($chars as $c) {
        $sum += intval($c);
    }

    return $sum;
}

$example = sum_of_digits(2, 15);
$real = sum_of_digits(2, 1_000);

echo "The sum of the digits for 2^5 is: {$example}\n";
echo "The sum of the digits for 2^1000 is: {$real}";
