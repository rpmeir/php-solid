<?php

use Src\Lsp\Grade;
use Src\Lsp\RoundedArithmeticAverageCalculator;

require_once __DIR__ . '/vendor/autoload.php';

$grades = [];
$grades[] = new Grade(2410002, 'exame', 5.7);
$grades[] = new Grade(2410002, 'exame', 5.9);
$averageCalculator = new RoundedArithmeticAverageCalculator();
$output = $averageCalculator::calculate($grades);

echo $output;
