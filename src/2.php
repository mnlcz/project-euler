<?php

require 'bootstrap.php';

$limit = 4_000_000;
$even_sum = 2;

function fib(int $left, int $right, int $limit, int &$even_sum): void
{
    if ($right >= $limit)
        return;

    $sum = $left + $right;
    $left = $right;
    $right = $sum;

    if ($right % 2 === 0)
        $even_sum += $right;

    fib($left, $right, $limit, $even_sum);
}

fib(1, 2, $limit, $even_sum);

var_dump($even_sum);