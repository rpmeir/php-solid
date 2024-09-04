<?php

use Src\Lsp\AverageRepositoryDatabase;
use Src\Lsp\CalculateAverage;
use Src\Lsp\GetAverage;
use Src\Lsp\GradeRepositoryDatabase;
use Src\Lsp\PostgresDatabaseAdapter;

require_once __DIR__ . '/vendor/autoload.php';

$databaseConnection = new PostgresDatabaseAdapter();
$gradeRepository = new GradeRepositoryDatabase($databaseConnection);
$averageRepository = new AverageRepositoryDatabase($databaseConnection);
$calculateAverage = new CalculateAverage($gradeRepository, $averageRepository);
$studentId = 2410001;
$calculateAverage->execute($studentId);
$getAverage = new GetAverage($averageRepository);
$output = $getAverage->execute($studentId);
$databaseConnection->close();

echo $output;
