<?php

namespace Tests\Lsp\Integration;

use Src\Lsp\ArithmeticAverageCalculator;
use Src\Lsp\AverageRepositoryDatabase;
use Src\Lsp\CalculateAverage;
use Src\Lsp\GetAverage;
use Src\Lsp\GradeRepositoryDatabase;
use Src\Lsp\PostgresDatabaseAdapter;
use Src\Lsp\RoundedArithmeticAverageCalculator;

test('Deve calcular a média de um aluno', function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($databaseConnection);
    $averageRepository = new AverageRepositoryDatabase($databaseConnection);
    $averageCalculator = new ArithmeticAverageCalculator();
    $calculateAverage = new CalculateAverage(
        $gradeRepository,
        $averageRepository,
        $averageCalculator);
    $studentId = 2410001;
    $averageRepository->deleteAverageByStudentId($studentId);
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(8.0);
    $databaseConnection->close();
});

test('Deve calcular a média arredondada para cima de um aluno', function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($databaseConnection);
    $averageRepository = new AverageRepositoryDatabase($databaseConnection);
    $averageCalculator = new RoundedArithmeticAverageCalculator();
    $calculateAverage = new CalculateAverage(
        $gradeRepository,
        $averageRepository,
        $averageCalculator);
    $studentId = 2410002;
    $averageRepository->deleteAverageByStudentId($studentId);
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(6.0);
    $databaseConnection->close();
});

test('Deve calcular a média de um aluno sem notas', function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($databaseConnection);
    $averageRepository = new AverageRepositoryDatabase($databaseConnection);

    $averageCalculator = new ArithmeticAverageCalculator();
    $calculateAverage = new CalculateAverage(
        $gradeRepository,
        $averageRepository,
        $averageCalculator);
    $studentId = 2410003;
    $averageRepository->deleteAverageByStudentId($studentId);
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(0.0);

    $roundedAverageCalculator = new RoundedArithmeticAverageCalculator();
    $calculateAverage = new CalculateAverage(
        $gradeRepository,
        $averageRepository,
        $roundedAverageCalculator);
    $studentId = 2410003;
    $averageRepository->deleteAverageByStudentId($studentId);
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(0.0);

    $databaseConnection->close();
});

test('Deve calcular a média de um aluno com uma nota muito baixa, desconsiderando a nota mais alta e a nota mais baixa', function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($databaseConnection);
    $averageRepository = new AverageRepositoryDatabase($databaseConnection);
    $averageCalculator = new ArithmeticAverageCalculator();
    $calculateAverage = new CalculateAverage(
        $gradeRepository,
        $averageRepository,
        $averageCalculator);
    $studentId = 2410004;
    $averageRepository->deleteAverageByStudentId($studentId);
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(8.0);
    $databaseConnection->close();
});
