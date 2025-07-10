<?php

declare(strict_types=1);

namespace Src\Lsp\Application\Repository;

use Src\Lsp\Domain\Average;

interface AverageRepository
{
    public function save(Average $average): void;
    public function getAverageByStudentId(int $studentId): Average;
    public function deleteAverageByStudentId(int $studentId): void;
}
