<?php

namespace App\Middleware;

class Authenticate {

    public static function auth()
    {
        if (empty($_SESSION['auth'])) {
            $_SESSION['error'] = 'Недостаточно прав! Авторизуйтесь!';
            exit(header('Location: /'));
        }
    }
}