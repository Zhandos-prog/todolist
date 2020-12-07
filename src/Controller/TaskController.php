<?php

namespace App\Controller;

use App\Middleware\Validation;
use App\Model\Task;
use App\Middleware\Authenticate;

class TaskController {


    private $data = [];

    public function add_task()
    {
       
        if ($_POST) {
            if (!empty($_POST['token']) && Authenticate::token_match($_POST['token']) == true) {
                
                $name = $_POST['name'];
                $email = $_POST['email'];
                $task = $_POST['task'];
                
                 $data = [
                    'name'=>$name, 
                    'email'=>$email, 
                    'task'=>$task
                ];
                $this->data = Validation::validate($data);
                $model = new Task;
                $result = $model->add_task($this->data);
                if ($result === true){
                    $_SESSION['success'] = 'Задача успешно создана!';
                    header('Location: /');
                }else {
                    $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                    header('Location: /');
                }
            }else {
                $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                header('Location: /');
            }
            
        }
    }

    public function update_task()
    {
        Authenticate::auth();
       
        if ($_POST) {
            if (!empty($_POST['token']) && Authenticate::token_match($_POST['token']) == true) {

                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = $_POST['email'];
                $task = $_POST['task'];
                $status = $_POST['status'];
                $data = [
                    'name'=>$name, 
                    'email'=>$email, 
                    'task'=>$task,
                    'status'=>$status,
                    'id'=>$id
                ];
                $this->data = Validation::validate($data);
                $model = new Task;
                $result = $model->update_task($this->data);
                if ($result === true){
                    $_SESSION['success'] = 'Запись успешно обновлена!';
                    header('Location: /');
                }else {
                    $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                    header('Location: /edit-task');
                }
            }else {
                $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                header('Location: /edit-task');
            }
        }
    }

    public function delete_task($id)
    {
        Authenticate::auth();
        
        if ($id) {
            $model = new \App\Model\Task();
            $result = $model->delete_task($id);
            if ($result===true) {
                $_SESSION['success'] = 'Задача успешно удалена!';
                header('Location: /');
            }else {
                $_SESSION['error'] = 'Что-то пошло не так! Попробуйте снова!';
                header('Location: /');
            }
        }
    }

   
}

