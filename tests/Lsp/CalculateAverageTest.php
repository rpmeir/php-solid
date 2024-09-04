<?php

namespace Tests\Lsp;

use Src\Lsp\AverageRepositoryDatabase;
use Src\Lsp\CalculateAverage;
use Src\Lsp\GetAverage;
use Src\Lsp\GradeRepositoryDatabase;
use Src\Lsp\PostgresDatabaseAdapter;

test('Deve calcular a média de um aluno', function () {
    $databaseConnection = new PostgresDatabaseAdapter();
    $gradeRepository = new GradeRepositoryDatabase($databaseConnection);
    $averageRepository = new AverageRepositoryDatabase($databaseConnection);
    $calculateAverage = new CalculateAverage($gradeRepository, $averageRepository);
    $studentId = 2410001;
    $calculateAverage->execute($studentId);
    $getAverage = new GetAverage($averageRepository);
    $output = $getAverage->execute($studentId);
    expect($output)->toBe(8.0);
    $databaseConnection->close();
});
