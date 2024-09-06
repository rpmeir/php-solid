<?php

namespace Tests\Lsp\Unit;

use Src\Lsp\AverageCalculatorTypeA;
use Src\Lsp\AverageCalculatorTypeB;
use Src\Lsp\Grade;

test('Deve calcular a média aritmética de um aluno', function () {
    $grades = [];
    $grades[] = new Grade(2410001, 'exame', 10);
    $grades[] = new Grade(2410001, 'exame', 9);
    $grades[] = new Grade(2410001, 'exame', 8);
    $averageCalculator = new AverageCalculatorTypeA();
    $output = $averageCalculator::calculate($grades);
    expect($output)->toBe(9.0);
});

test('Deve calcular a média aritmética arredondada para cima de um aluno', function () {
    $grades = [];
    $grades[] = new Grade(2410002, 'exame', 5.7);
    $grades[] = new Grade(2410002, 'exame', 5.9);
    $averageCalculator = new AverageCalculatorTypeB();
    $output = $averageCalculator::calculate($grades);
    expect($output)->toBe(6.0);
});
