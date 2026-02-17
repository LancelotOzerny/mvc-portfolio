<?php

namespace Modules\Main;

use Models\User;
use Modules\Orm\Entity;
use Repositories\UserRepository;

class Authenticator
{
    public static function logout() : void
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            return;
        }

        unset($_SESSION['user_id']);
        unset($_SESSION['user']);
        $_SESSION = [];

        session_destroy();
    }

    public static function login($email, $password) : bool
    {
        $errors = [];
        $user = new UserRepository(new User())->findByEmail($email);

        if (empty($errors) && $user->password_hash)
        {
            if (password_verify($password, $user->password_hash))
            {
                if (session_status() === PHP_SESSION_NONE)
                {
                    session_start();
                }

                $_SESSION['login_time'] = time();
                $_SESSION['user_id'] = $user->id;
                $_SESSION['user'] = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'right_name' => $user->right_name,
                    'right_level' => $user->right_level
                ];

                return true;
            }
        }

        return false;
    }

    public static function isAuthorized() : bool
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            return false;
        }

        return isset($_SESSION['user_id']);
    }

    public static function isAdmin() : bool
    {
        return !self::isAuthorized() ?: $_SESSION['user']['right_level'] >= 100;
    }

    public static function getCurrentUser() : ?Entity
    {
        if (!self::isAuthorized())
        {
            return null;
        }

        if (isset($_SESSION['user']) && false)
        {
            $userData = $_SESSION['user'];
            $user = new User();
            $user->id = $userData['id'];
            $user->email = $userData['email'];
            $user->role = $userData['role'];
            $user->role_level = $userData['role_level'];

            return $user;
        }

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId)
        {
            return null;
        }

        $userRepo = new UserRepository(new User());
        $user = $userRepo->findById($userId);

        if ($user)
        {
            $_SESSION['user'] =
            [
                'id' => $user->id,
                'email' => $user->email,
                'role' => $user->role,
                'role_level' => $user->role_level
            ];
        }

        return $user;
    }
}