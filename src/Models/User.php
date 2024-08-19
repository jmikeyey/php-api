<?php 

// src/Models/User.php
namespace App\Models;

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsers() {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getSoloUser($id) {
      $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
      $stmt->execute([$id]);
      $user = $stmt->fetchAll(\PDO::FETCH_ASSOC);
      if (empty($user)) {
          return ['success'=> true, 'message' => 'No user found']; // Or you can return a specific message or handle it differently
      }
      return $user;
    }
    public function createUser($name, $email) {
        // Check if email already exists
        if ($this->emailExists($email)) {
          throw new \Exception("Email already exists");
        } 
        $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function updateUser($id, $data){
      $stmt = $this->db->prepare("UPDATE `users` SET `name` = ?, `email` = ? WHERE `id` = ?;");
      $stmt->execute([$data['name'],$data['email'],$id]);
    }

    // ** private functions
    private function emailExists($email) {
      $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM users WHERE email = ?");
      $stmt->execute([$email]);
      $result = $stmt->fetch(\PDO::FETCH_ASSOC);

      return $result['count'] > 0;
    }
}
