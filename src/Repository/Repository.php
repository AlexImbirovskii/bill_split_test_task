<?php

namespace App\Repository;
use Database\Database;
use PDO;
use App\Repository\Interface\RepositoryInterface;

class Repository implements RepositoryInterface
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function getPDO(): ?PDO
    {
        return $this->database->getPDO();
    }

    public function getDatabase(): Database
    {
        return $this->database;
    }
}