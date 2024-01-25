<?php

require 'bootstrap.php';

$limit = 4_000_000;

$fibs = collect([2]);

function fib(int $left, int $right, int $limit, \Illuminate\Support\Collection $fibs): void
{
    if ($right >= $limit)
        return;

    $sum = $left + $right;
    $left = $right;
    $right = $sum;

    if ($right % 2 === 0)
        $fibs->add($right);

    fib($left, $right, $limit, $fibs);
}

fib(1, 2, $limit, $fibs);

$sum = $fibs->sum();

var_dump($sum);