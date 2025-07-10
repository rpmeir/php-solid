<?php

declare(strict_types=1);

namespace Src\Lsp\Application\UseCase;

use Src\Lsp\Application\Repository\AverageRepository;

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
