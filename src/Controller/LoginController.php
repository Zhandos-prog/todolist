<?php

namespace App\Controller;

class LoginController {

    private $data = [];

    public function auth()
    {
        if ($_POST) {
            $name = $_POST['name'];
            $password = $_POST['password'];

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
        }
    }

    public function logout()
    {
        unset($_SESSION['auth']);
        header('Location: /');
    }
}