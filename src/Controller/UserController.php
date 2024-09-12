<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\Validator;

class UserController extends Controller
{
    private array $routes = [
        'GET' => 'getAllUsers',
        'POST' => 'addUser',
        'DELETE' => 'resetUsers',
    ];

    public function getAllUsers(): false|string
    {
        header('Content-Type: application/json');
        return json_encode((new UserRepository())->getAllUsers());
    }

    public function addUser(): false|string
    {
        header('Content-Type: application/json');

        $validator = new Validator();

        $errors = $validator->validateUser();

        if (empty($errors)) {
            $repository = new UserRepository();

            $errors = $repository->addUser(
                $_POST['name'],
                $_POST['email']
            );

            $repository->recalculateUserDebt();

            http_response_code(empty($errors) ? 201 : 422);
            return json_encode([
                'message' => 'Created',
                'errors' => $errors
            ]);
        }

        http_response_code(422);
        return json_encode([
            'message' => 'Unprocessable entity',
            'errors' => $errors
        ]);
    }

    public function resetUsers(): false|string
    {
        header('Content-Type: application/json');
        (new UserRepository())->resetUsers();
        return json_encode([
            'message' => 'Success',
        ]);
    }

    public function getRoutes(): array
    {
        return $this->routes;
    }
}