<?php

namespace App\Controller;
use App\Middleware\Authenticate;
use App\Controller\Errors;

class HomeController {

    private $limit = 3;
    private $pageCount = 0;

    public function show_home()
    {
        $sort_list = [
            'name' => '`name`',
            'email' => '`email`',
            'status' => '`status`',   
        ];
         
        $sort = @$_GET['sort'];
        if (array_key_exists($sort, $sort_list)) {
            $sort_table = $sort_list[$sort];
        } else {
            $sort_table = '`id`'. ' ' .'asc';
        }

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        if (empty($page)) $page = 1;
        $offset = ($page-1)*$this->limit;
        if ($offset < 0) $offset = 0;
        $model = new \App\Model\Task();
        $count = $model->get_task_count();
        $data['count'] = $count[0]['count'];
        $pageCount = $data['count'] / $this->limit;
        $this->pageCount = ceil($pageCount);
        if ($page > $this->pageCount) {
            Errors::show_error_page();
            die;
        }
        $data['page'] = $this->pageCount;
        $data['tasks'] = $model->get_tasks($this->limit, $offset, $sort_table);
        $view = new \App\View\Home();
        $view->render($data);
    }

    public function show_edit_task($id)
    {
        Authenticate::auth();
        
        if ($id) {
            $model = new \App\Model\Task();
            $data = $model->get_task($id);
        }
        

        $view = new \App\View\Task();
        $view->render($data);
        
    }
}