<?php

declare(strict_types=1);

namespace Src\Lsp;

use Src\DatabaseConnection;

class AverageRepositoryDatabase implements AverageRepository
{
    public function __construct(public readonly DatabaseConnection $databaseConnection)
    {
    }

    public function save(Average $average): void
    {
        $this->databaseConnection->query(
            'INSERT INTO lsp.averages (student_id, value) VALUES (?, ?)',
            [$average->student_id, $average->value]
        );
    }

    public function getAverageByStudentId(int $studentId): Average
    {
        [$average] = $this->databaseConnection->query(
            'SELECT student_id, value FROM lsp.averages WHERE student_id = ?',
            [$studentId]
        );
        return new Average((int) $average['student_id'], (float) $average['value']);
    }

    public function deleteAverageByStudentId(int $studentId): void
    {
        $this->databaseConnection->query(
            'DELETE FROM lsp.averages WHERE student_id = ?',
            [$studentId]
        );
    }
}
