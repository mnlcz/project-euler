<?php

/*
 * The following iterative sequence is defined for the set of positive integers:
 *      n -> n / 2      (n is even)
 *      n -> 3n + 1     (n is odd)
 * Using the rule above and starting with 13, we generate the following sequence:
 *      13 -> 40 -> 20 -> 10 -> 5 -> 16 -> 8 -> 4 -> 2 -> 1
 * It can be seen that this sequence (starting at 13 and finishing at 1) contains 10 terms.
 * Although it has not been proved yet (Collatz Problem), it is thought that all starting numbers finish at 1.
 * Which starting number, under one million, produces the longest chain?
 * NOTE: Once the chain starts the terms are allowed to go above one million.
 */

require 'bootstrap.php';

$collatz_lenghts = new Illuminate\Support\Collection;

function starter_for_longest_sequence(int $collatz_limit, int $time_limit = 5): int|string
{
    $start_time = microtime(true);
    $time_exceeded = fn ($current_time) => $current_time - $start_time > $time_limit;

    $starter = -1;
    $longest = PHP_INT_MIN;

    for ($i = 1; $i < $collatz_limit; $i++) {
        if ($time_exceeded(microtime(true)))
            return "Execution paused. Time limit exceeded.";

        $len = collatz_sequence_length($i);

        if ($len > $longest) {
            $starter = $i;
            $longest = $len;
        }
    }

    return $starter;
}

function collatz_sequence_length(int $n): int
{
    global $collatz_lenghts;

    if ($collatz_lenghts->has($n)) {
        return $collatz_lenghts->get($n);
    }

    $odd = fn ($n) => 3 * $n + 1;
    $even = fn ($n) => intdiv($n, 2);

    $len = 1;
    $original = $n;

    while ($n !== 1) {
        $n = $n % 2 === 0 ? $even($n) : $odd($n);
        $len++;

        if ($collatz_lenghts->has($n)) {
            /*
             * $original = 10
             *      Seq: 10 -> 5 -> 16 -> 8 -> 4 -> 2 -> 1
             * Assume $collatz_lengths has $n = 5
             *      Seq: 5 -> 16 -> 8 -> 4 -> 2 -> 1
             * Therefore len of 10 is:
             *      current_len (2) + len_of_5 (6)
             *            {10 -> 5} + {5 -> 16 -> 8 -> 4 -> 2 -> 1}
             * Because we are counting 5 in both seq we have to subtract 1 to the len of 5
             */
            $len += $collatz_lenghts->get($n) - 1;
            break;
        }
    }

    $collatz_lenghts->put($original, $len);

    return $len;
}

echo 'Starting number for longest Collatz sequence under 1mill: ' . starter_for_longest_sequence(1_000_000, 10);
