<?php

namespace App\Controller;
use App\Middleware\Authenticate;
class LoginController {

    private $data = [];


    public function auth()
    {
        if ($_POST) {
            if (!empty($_POST['token']) && Authenticate::token_match($_POST['token']) == true) {

                $name = trim($_POST['name']);
                $password = trim($_POST['password']);

                $this->data = [
                    'name'=>$name,
                    'password'=>$password,
                ];

                $model = new \App\Model\User();
                $user = $model->auth($this->data);
                if ($user) {
                    $_SESSION['auth'] = $user;
                    header('Location: /');
                }else {
                    $_SESSION['error'] = 'Пользователь не найден!';
                    header('Location: /');
                }
            }else {
                $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                header('Location: /');
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        header('Location: /');
    }
}