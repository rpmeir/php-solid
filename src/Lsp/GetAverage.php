<?php

declare(strict_types=1);

namespace Src\Lsp;

class GetAverage
{
    public function __construct(public readonly AverageRepository $averageRepository)
    {
    }

    public function execute(int $studentId): int|float
    {
        $average = $this->averageRepository->getAverageByStudentId($studentId);
        return $average->value;
    }
}
