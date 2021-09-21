<?php

namespace Models;

use \Libraries\Database;

class User {
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function insert($data) {
        $this->db->query('INSERT INTO users stuff');
        $this->db->bind('fullname', $data['fullname']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('city', $data['city']);
        $this->db->bind('pwd', password_hash($data['pwd'], PASSWORD_DEFAULT));

        $result = $this->db->execute() ? true : false;
        return $result;
    }

    public function checkLogin($data) {
        $this->db->query('SELECT * FROM users WHERE email=:e');
        $this->db->bind('e', $data['email']);

        if($this->db->fetch()) {
            $result = $this->db->fetch();
            if(password_verify($data['pwd'], $result->pwd)) {
                return $result;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getUserData($id) {
        $this->db->query('SELECT * FROM users WHERE id=:e LIMIT 1');
        $this->db->bind('e', $id);
        $result = $this->db->fetch();
        return $result ? $result : [0];
    }

    public function updatePassword($data) {
        $this->db->query('UPDATE users SET pwd=:pswd WHERE id=:id');
        $this->db->bind('pswd', password_hash($data, PASSWORD_DEFAULT));
        $this->db->bind('id', $_SESSION['user_id']);
        $result = $this->db->execute() ? true : false;
        return $result;
    }
    
    public function updateData($data) {
        $this->db->query('UPDATE users SET stuff');
        $this->db->bind('fullname', trim($data['fullname']));
        $this->db->bind('email', trim($data['email']));
        $this->db->bind('id', $_SESSION['user_id']);
        $result = $this->db->execute() ? true : false;
        return $result;
    }

    public function isAdmin() : bool {
        $this->db->query('SELECT role FROM users WHERE id=:e LIMIT 1');
        $this->db->bind('e', $_SESSION['user_id']);
        $result = $this->db->fetch();
        return $result['role'] === 'admin' ? true : false;
    }
}