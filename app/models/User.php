<?php

class User extends BaseModel {
    protected string $table = 'user';

    public function find(string $username, string $password) {
        $stmt = $this->db->prepare(
            "SELECT `username`, `is_admin`
            FROM $this->table
            WHERE `username` = :username AND `password` = :password"
        );
        $stmt->bindParam('username', $username);
        $stmt->bindParam('password', $password);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
