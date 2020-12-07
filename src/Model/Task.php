<?php

namespace App\Model;
class Task {

    public function add_task(array $data)  // добавляем таск
    {
        $conn_db = new \App\Service\DB(); 
        $db = $conn_db->get();
        $stmt = $db->prepare("
            INSERT INTO
                `tasks` (
                `name`,
                `email`,
                `task`,
                `status`,
                `admin_edit`
                )
                VALUES (
                :name,
                :email,
                :task,
                :status,
                :admin_edit
                )
            ");
        $result = $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':task'=>$data['task'],
            ':status'=>0,
            ':admin_edit'=>0
        ]);
        return $result;
    }

    public function get_task_count()
    {
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt = $db->prepare("
            SELECT
                COUNT(*) as count
            FROM 
                `tasks`
        ");
        $stmt->execute();
        return $stmt->fetchAll();
        
    }
    public function get_tasks($limit, $offset=0, $sort) // получаем все таски
    { 
        
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt = $db->prepare("
            SELECT
                *
            FROM 
                `tasks`
            ORDER BY $sort LIMIT $limit OFFSET $offset
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function check_task_edit($id, $text) // проверяем на изменение
    { 
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt = $db->prepare("
            SELECT 
                `task`
            FROM
                `tasks`
            WHERE :id = `id`

        ");
        $stmt->execute([
            ':id' => $id
        ]);
        $result = $stmt->fetch();
        if (strcasecmp($result['task'], $text) == 0) {
            return 0;
        }else {
            return 1;
        }
    }

    public function update_task(array $data)  // обновляем нужный таск
    {
        $id = $data['id'];
        $edit_task = $this->check_task_edit($id, $data['task']);
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt = $db->prepare("
            UPDATE 
                `tasks`
            SET 
                `name` = :name,
                `email` = :email,
                `task` = :task,
                `status` = :status,
                `admin_edit`=:admin_edit
            WHERE `id` = $id
            ");
        $result = $stmt->execute([
            ':name' => $data['name'],
            ':email' => $data['email'],
            ':task'=>$data['task'],
            ':status'=>$data['status'],
            ':admin_edit'=>$edit_task
        ]);
        return $result;
    }

    public function get_task($id) // получаем нужный таск
    {
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt= $db->prepare("
            SELECT *
                FROM
                    `tasks`
                WHERE
                    `id` = :id
        ");
        $stmt->execute([':id' => $id]);
        $data = $stmt->fetch();
        return $data;
    }

    public function delete_task($id) // удаляем таск
    {
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt= $db->prepare("
            DELETE 
                FROM
                    `tasks`
                WHERE
                    `id` = :id
        ");
        $result = $stmt->execute([':id' => $id]);
        return $result;
    }
}