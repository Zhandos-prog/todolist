<?php

namespace App\Middleware;

class Authenticate {

    private static $token = null;
    
    public static function token_match($token)
    {
        return hash_equals($token, $_SESSION['token']);
    }

    public static function csrf() {
        self::$token = !empty($_SESSION['token']) ? $_SESSION['token'] : self::create_token();
        return self::$token;
    }

    private static function create_token($length = 42)
    {
        $chars = '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';
        $max = strlen($chars)-1;
        $token = '';

        for($i=0; $i<$length; ++$i) {
            $token .= $chars[rand(0,$max)];
        }
        $token = md5($token);
        $_SESSION['token'] = $token;

        return $token;
    }

    public static function auth()
    {
        if (empty($_SESSION['auth'])) {
            $_SESSION['error'] = 'Недостаточно прав! Авторизуйтесь!';
            exit(header('Location: /'));
        }
    }
}