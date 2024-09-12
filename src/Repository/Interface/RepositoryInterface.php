<?php

namespace App\Repository\Interface;

use Database\Database;
use PDO;

interface RepositoryInterface
{
    public function getPDO(): ?PDO;

    public function getDatabase(): Database;
}