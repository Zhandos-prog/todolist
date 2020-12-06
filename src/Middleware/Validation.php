<?php

namespace App\Middleware;

class Validation {

    private static $min_name = 2;
    private static $max_name = 40;
    private static $min_task = 20;
    private static $max_task = 500;

    public static function validate(array $data)
    {
        $url = parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH);
        if (is_array($data)) {
            if ($data['name'] == '' || $data['email'] == '' || $data['task'] == '') {
               $_SESSION['valid'] = 'Все поля обязательные для заполнения!';
               if (preg_match('/edit/', $url)) {
                   header("Location: $url");
                }else {
                    header('Location: /');
                }
               
            }else if(mb_strlen($data['name']) < self::$min_name || mb_strlen($data['name'] > self::$max_name)) {
                $_SESSION['valid'] = 'Имя должно состоять минимум из 2, максимум из 40 букв!';
                if (preg_match('/edit/', $url)) {
                    header("Location: $url");
                 }else {
                     header('Location: /');
                 }
            }else if(mb_strlen($data['task']) < self::$min_task || mb_strlen($data['task']) > self::$max_task) {
                $_SESSION['valid'] = 'Задача должна содержать минимум 20 символов, максимум 500 символов!';
                if (preg_match('/edit/', $url)) {
                    header("Location: $url");
                 }else {
                     header('Location: /');
                 }
            }else {
                return $data;
            }
        }
    }
}