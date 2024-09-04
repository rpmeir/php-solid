<?php

namespace Src\Lsp;

class CalculateAverage {
    public function __construct(
        public readonly GradeRepository $gradeRepository,
        public readonly AverageRepository $averageRepository)
    {
    }

    public function execute(int $studentId): void
    {
        $grades = $this->gradeRepository->getGradesByStudentId($studentId);
        $sum = 0;
        foreach ($grades as $grade) {
            $sum += $grade->value;
        }
        $average = new Average($studentId, $sum / count($grades));
        $this->averageRepository->save($average);
    }
}
