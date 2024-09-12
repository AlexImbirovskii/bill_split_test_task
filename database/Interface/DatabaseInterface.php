<?php

namespace Database\Interface;

use PDO;

interface DatabaseInterface
{
    public function connect(): DatabaseInterface;

    public function disconnect(): void;

    public function getPDO(): ?PDO;

    public function migrate(string $sql): DatabaseInterface;
}