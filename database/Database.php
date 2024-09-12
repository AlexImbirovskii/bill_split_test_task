<?php

namespace Database;

use Database\Interface\DatabaseInterface;
use PDO;
use PDOException;

class Database implements DatabaseInterface
{
    private string $host;
    private string $db;
    private string $user;
    private string $password;
    private string $source;

    private ?PDO $pdo;

    public function __construct() {
        $this->host = getenv('DB_HOST');
        $this->db = getenv('DB_NAME');
        $this->user = getenv('DB_USER');
        $this->password = getenv('DB_PASS');
        $this->source = getenv('DB_SOURCE');
    }

    public function connect(): DatabaseInterface
    {
        try {
            $this->pdo = new PDO("$this->source:host=$this->host;dbname=$this->db", $this->user, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }

        return $this;
    }

    public function disconnect(): void
    {
        $this->pdo = null;
    }

    public function migrate($sql): DatabaseInterface
    {
        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            die("Error executing migration: " . $e->getMessage());
        }

        return $this;
    }

    public function getPDO(): ?PDO
    {
        return $this->pdo;
    }
}