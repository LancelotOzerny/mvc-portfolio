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

    public static function getCurrentUser(): Entity | null
    {
        if (!self::isAuthorized())
        {
            return null;
        }

        $userId = $_SESSION['user_id'] ?? null;
        if (!$userId)
        {
            return null;
        }

        $userRepo = new Repository(new User());
        return $userRepo->findById($userId);
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
                $_SESSION['is_authorized'] = true;

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

        return isset($_SESSION['is_authorized']);
    }
}