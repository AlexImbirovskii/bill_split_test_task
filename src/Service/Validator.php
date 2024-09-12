<?php

namespace App\Service;

class Validator
{
    public function validateUser(): array
    {
        $name = $_POST['name'] ?? null;
        $email = $_POST['email'] ?? null;

        $errors = [];

        if (empty($name)) {
            $errors['name'][] = 'Name is required.';
        } else if (strlen($name) > 254) {
            $errors['name'][] = 'Name can not be longer than 254.';
        }

        if (empty($email)) {
            $errors['email'][] = 'Email is required.';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'][] = 'Invalid email format.';
        } else if (strlen($email) > 254) {
            $errors['email'][] = 'Email can not be longer than 254.';
        }

        return $errors;
    }
}