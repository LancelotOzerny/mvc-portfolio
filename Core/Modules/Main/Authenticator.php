<?php

namespace Modules\Main;

use Models\User;
use Modules\Orm\Entity;
use Modules\Orm\Repository;
use Repositories\UserRepository;

class Authenticator
{
    public static function logout() : void
    {
        if (session_status() === PHP_SESSION_NONE)
        {
            return;
        }

        $_SESSION = [];

        if (ini_get("session.use_cookies"))
        {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

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

        if (isset($_SESSION['user']))
        {
            $userData = $_SESSION['user'];
            $user = new User();
            $user->id = $userData['id'];
            $user->email = $userData['email'];
            $user->right_name = $userData['right_name'];
            $user->right_level = $userData['right_level'];

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
                'right_name' => $user->right_name,
                'right_level' => $user->right_level
            ];
        }

        return $user;
    }
}