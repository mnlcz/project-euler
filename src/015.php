<?php

/*
 * Starting in the top left corner of a 2 x 2 grid, and only being able to move to the right and down, 
 * there are exactly 6 routes to the bottom right corner.
 *      ➡➡⬇⬇      ➡⬇➡⬇      ➡⬇⬇➡      ⬇➡➡⬇      ⬇➡⬇➡      ⬇⬇➡➡
 * How many such routes are there through a 20 x 20 grid?
 */

require 'bootstrap.php';

// https://math.stackexchange.com/questions/286437/arrangement-of-binary-bits
function effective_routes_math(int $grid_size): int
{
    return gmp_intval(gmp_fact($grid_size * 2) / (gmp_fact($grid_size) ** 2));
}

function effective_routes_iter(int $grid_size): int
{
    $grid = [];

    // Grid of $grid_size+1 x $grid_size+1. Filled with 1
    for ($i = 0; $i < $grid_size + 1; $i++) {
        $grid[$i] = array_fill(0, $grid_size + 1, 1);
    }

    /* 
     * Steps to go to X pos is equal to the sum of steps for the Upper pos and the Left pos:
     *      [1][1]
     *      [1][1] <- Upper (1) + Left (1) = 2
     */
    for ($i = 1; $i < $grid_size + 1; $i++) {
        for ($j = 1; $j < $grid_size + 1; $j++) {
            $left_val = $grid[$i - 1][$j];
            $up_val = $grid[$i][$j - 1];
            $grid[$i][$j] = $left_val + $up_val;
        }
    }

    return $grid[$grid_size][$grid_size];
}

echo '[Math] For a 2x2 grid: ' . effective_routes_math(2) . PHP_EOL;
echo '[Math] For a 20x20 grid: ' . effective_routes_math(20) . PHP_EOL;

echo '[Iter] For a 2x2 grid: ' . effective_routes_iter(2) . PHP_EOL;
echo '[Iter] For a 20x20 grid: ' . effective_routes_iter(20);
