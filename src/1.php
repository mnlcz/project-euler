<?php

require __DIR__ . '/../vendor/autoload.php';

$sum = collect(range(1, 999))->filter(fn($n) => $n % 3 === 0 || $n % 5 === 0)->sum();

var_dump($sum);
