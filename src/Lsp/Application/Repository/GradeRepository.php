<?php

declare(strict_types=1);

namespace Src\Lsp\Application\Repository;

use Src\Lsp\Domain\Grade;

interface GradeRepository
{
    /**
     * Summary of getGradesByStudentId
     *
     * @return array<Grade>
     */
    public function getGradesByStudentId(int $studentId): array;
}
