<?php

namespace Controllers;

use Models\User;
use Modules\Main\Application;
use Modules\Validator\EmailValidator;
use Modules\Validator\StringValidator;
use Repositories\UserRepository;

class AuthController
{
    public function login(): void
    {
        echo 'login';
    }

    public function register(): void
    {
        $post = Application::getInstance()->post;

        if ($post->has('email') === false || $post->has('password') === false)
        {
            echo json_encode(['errors' => ['empty email or password']]);
        }

        $email = $post->get('email');
        $password = $post->get('password');

        if ((new UserRepository(new User()))->findByEmail($email))
        {
            echo json_encode(['errors' => ['Пользователь с данным email уже существует!']]);
            return;
        }

        /* VALIDATE */
        $passwordValidator = new StringValidator(
            minLength: 8,
            allowedChars: array_merge(
                range('a', 'z'),
                range('A', 'Z'),
                range('0', '9'),
                ['!', '@', '#', '$', '%']
            )
        );
        $isCorrectPassword = $passwordValidator->validate($password);

        $emailValidator = new EmailValidator();
        $isCorrectEmail = $emailValidator->validate($email);

        $errors = [];
        if (!$isCorrectEmail)
        {
            $errors[] = $emailValidator->getError();
        }

        if (!$isCorrectPassword)
        {
            $errors[] = $passwordValidator->getError();
        }

        if (count($errors))
        {
            echo json_encode(['errors' => $errors]);
            return;
        }

        $user = new User();
        $user->email = $email;
        $user->password_hash = password_hash($password, PASSWORD_DEFAULT);

        $newUser = new UserRepository($user)->create();
        header('Content-Type: application/json');
        echo json_encode([
            'status' => is_null($newUser) ? 'failure' : 'success',
            'user' => $newUser->getFields()
        ]);
    }
}