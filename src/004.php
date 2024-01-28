<?php

/*
 * A palindromic number reads the same both ways.
 * The largest palindrome made from the product of two 2-digit numbers is 9009 = 91 . 99.
 * Find the largest palindrome made from the product of two 3-digit numbers.
 */

require 'bootstrap.php';

function largest_palindrome(int $digits) : string
{
    $max = generate_starting_number($digits);
    $min = generate_starting_number($digits - 1);

    $largest_palindrome = 0;

    for ($i = $max; $i >= $min; $i--) {
        for ($j = $max; $j >= $min; $j--) {
            $product = $i * $j;
            if (is_palindrome($product) && $product > $largest_palindrome) {
                $largest_palindrome = $product;
            }
        }
    }

    return strval($largest_palindrome);
}

function generate_starting_number(int $digits) : int
{
    return intval(str_repeat('9', $digits));
}

function is_palindrome(int $num) : bool
{
    return strval($num) === strrev(strval($num));
}

echo 'Largest palindrome with 2 digit multiplication: ' . largest_palindrome(2) . "\n";
echo 'Largest palindrome with 3 digit multiplication: ' . largest_palindrome(3);
