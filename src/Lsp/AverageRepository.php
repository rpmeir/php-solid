<?php

declare(strict_types=1);

namespace Src\Lsp;

interface AverageRepository
{
    public function save(Average $average): void;
    public function getAverageByStudentId(int $studentId): Average;
    public function deleteAverageByStudentId(int $studentId): void;
}
