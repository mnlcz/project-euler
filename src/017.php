<?php

/*
 * If the numbers 1 to 5 are written out in words: one, two, three, four, five
 * then there are 3 + 3 + 5 + 4 + 4 = 19 letters used in total.
 *
 * If all the numbers from 1 to 1000 (one thousand) inclusive were written out
 * in words, how many letters would be used?
 *
 * NOTE: do not count spaces or hyphens. For example, 342 (three hundred and
 * forty-two) contains 23 letters and 115 (one hundred and fifteen) contains
 * 20 letters. The use of "and" when writing out numbers is in compliance with
 * Britigh usage.
 */

require 'bootstrap.php';

$singles = [
    0 => '',
    1 => 'one',
    2 => 'two',
    3 => 'three',
    4 => 'four',
    5 => 'five',
    6 => 'six',
    7 => 'seven',
    8 => 'eight',
    9 => 'nine',
];

$specials = [
    10 => 'ten',
    11 => 'eleven',
    12 => 'twelve',
    13 => 'thirteen',
    15 => 'fifteen',
    18 => 'eighteen',
];

$doubles = [
    1 => 'teen',
    2 => 'twenty',
    3 => 'thirty',
    4 => 'forty',
    5 => 'fifty',
    6 => 'sixty',
    7 => 'seventy',
    8 => 'eighty',
    9 => 'ninety',
];

function number_letter_counts(int $upto = 1000): int
{
    global $singles;

    $range = range(1, $upto);
    $count = 0;

    foreach ($range as $num) {
        $s = strval($num);
        $len = strlen($s);

        if ($len === 1) {
            $count += strlen($singles[$num]);
        } elseif ($len === 2) {
            $count += strlen(two_digits_parser($num));
        } elseif ($len === 3) {
            $count += strlen(three_digits_parser($num));
        } else {
            $count += strlen('onethousand');
            break;
        }
    }

    return $count;
}

function two_digits_parser(int $num): string
{
    global $singles;
    global $specials;
    global $doubles;

    $s = strval($num);

    return array_key_exists($num, $specials)
        ? $specials[$num]
        : $doubles[intval($s[0])].$singles[intval($s[1])];
}

function three_digits_parser(int $num): string
{
    global $singles;

    $s = strval($num);
    $two_last = "{$s[1]}{$s[2]}";
    $out = $singles[intval($s[0])].'hundred';

    if ($two_last[0] === '0' && $two_last[1] !== '0') {
        $out .= 'and'.$singles[intval($two_last[1])];
    } elseif ($two_last !== '00') {
        $out .= 'and'.two_digits_parser(intval($two_last));
    }

    return $out;
}

echo 'The total of letters used for 1 to 1000: '.number_letter_counts(1000);
