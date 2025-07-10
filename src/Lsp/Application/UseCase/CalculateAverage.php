<?php

declare(strict_types=1);

namespace Src\Lsp\Application\UseCase;

use Src\Lsp\Application\Repository\AverageRepository;
use Src\Lsp\Application\Repository\GradeRepository;
use Src\Lsp\Domain\Average;

class CalculateAverage
{
    public function __construct(
        public readonly GradeRepository $gradeRepository,
        public readonly AverageRepository $averageRepository,
        public readonly AverageCalculator $averageCalculator
    ) {
    }

    public function execute(int $studentId): void
    {
        $grades = $this->gradeRepository->getGradesByStudentId($studentId);
        $value = $this->averageCalculator::calculate($grades);
        $average = new Average($studentId, $value);
        $this->averageRepository->save($average);
    }
}
