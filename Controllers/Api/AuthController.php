<?php

namespace Controllers\Api;

use Models\User;
use Modules\Main\Application;
use Modules\Main\Authenticator;
use Modules\Main\BaseController;
use Modules\Validator\EmailValidator;
use Modules\Validator\StringValidator;
use Repositories\UserRepository;

class AuthController extends BaseController
{
    public function login(): void
    {
        $post = Application::getInstance()->post;

        $email = $post->get('email');
        $password = $post->get('password');

        $isAuthorized = Authenticator::login($email, $password);

        header('Content-Type: application/json');
        if ($isAuthorized)
        {
            echo json_encode([
                'status' => 'success',
                'authorized' => Authenticator::isAuthorized() ? 'YES' : 'NO',
            ]);
            return;
        }

        echo json_encode(['errors' => ['Проверьте логин или пароль!']]);
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
            maxLength: 8,
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