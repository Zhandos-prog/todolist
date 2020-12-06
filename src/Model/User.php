<?php

namespace App\Model;

class User {

    public function auth(array $data)
    {
        $conn_db = new \App\Service\DB();
        $db = $conn_db->get();
        $stmt = $db->prepare("
        SELECT 
            `name`
        FROM
            `users`
        WHERE 
        `name` = :name AND `password` = :password
        ");
        $stmt->execute([
            ':name' => $data['name'],
            ':password' => $data['password']
        ]);
        $user = $stmt->fetch();

        return $user;
    }
}