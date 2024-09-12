<?php

namespace App\Repository;
use PDO;
use PDOException;

class UserRepository extends Repository
{
    const BILL_PRICE = 100;

    public function getAllUsers(): array
    {
        try {
            $this->getDatabase()->connect();

            $query = $this->getPDO()->prepare("SELECT * FROM users");
            $query->execute();
            $users = $query->fetchAll(PDO::FETCH_ASSOC);

            $this->getDatabase()->disconnect();

            return $users;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function addUser(string $name, string $email): array
    {
        try {
            $this->getDatabase()->connect();

            $query = $this->getPDO()->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
            $query->bindParam(':name', $name);
            $query->bindParam(':email', $email);
            $query->execute();

            $this->getDatabase()->disconnect();
        } catch (PDOException $e) {
            $message = $e->getMessage();
            if (str_contains($message, 'Unique violation')) {
                return [
                    'email' => [
                        'Email already exists'
                    ]
                ];
            } else {
                die($e->getMessage());
            }
        }

        return [];
    }

    public function resetUsers(): void
    {
        try {
            $this->getDatabase()->connect();

            $query = $this->getPDO()->prepare("DELETE FROM users");
            $query->execute();

            $this->getDatabase()->disconnect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function recalculateUserDebt(): void
    {
        try {
            $this->getDatabase()->connect();

            $query = $this->getPDO()->prepare(
                sprintf(
                    "
                        UPDATE users
                            SET debt = ROUND(
                                %s / (SELECT count::decimal FROM (SELECT COUNT(*) AS count FROM users) AS subquery
                            ), 2)
                    ", self::BILL_PRICE
                )
            );
            $query->execute();

            $this->getDatabase()->disconnect();
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}