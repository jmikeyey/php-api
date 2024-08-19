<?php 

// src/Controllers/UserController.php
namespace App\Controllers;

use App\Models\User;

class UserController {
    private $userModel;
    public $params;

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function index() {
        try {
            $users = $this->userModel->getAllUsers();
            header('Content-Type: application/json');
            echo json_encode($users);
        } catch (\Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
    public function getAll() {
      try {
          $users = $this->userModel->getAllUsers();
          header('Content-Type: application/json');
          echo json_encode($users);
      } catch (\Exception $e) {
          echo json_encode(['error' => $e->getMessage()]);
      }
  }
    public function indexSolo() {
      $id = $this->params['id'];
      try {
          $users = $this->userModel->getSoloUser($id);
          header('Content-Type: application/json');
          echo json_encode($users);
      } catch (\Exception $e) {
          echo json_encode(['error' => $e->getMessage()]);
      }
    }
    public function store() {
      $data = json_decode(file_get_contents('php://input'), true);

      if (!isset($data['name']) || !isset($data['email'])) {
          http_response_code(400);
          echo json_encode(['error' => 'Invalid input']);
          return;
      }

      try {
          $this->userModel->createUser($data['name'], $data['email']);
          http_response_code(201);
          echo json_encode(['message' => 'User created successfully']);
      } catch (\Exception $e) {
          http_response_code(500);
          echo json_encode(['error' => $e->getMessage()]);
      }
  }

  public function delete() {
    $id = $this->params['id'];

    try {
        $this->userModel->deleteUser($id);
        http_response_code(200);
        echo json_encode(['message' => "User with ID $id deleted successfully"]);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
  }

  public function update() {
    $id = $this->params['id'];
    $data = json_decode(file_get_contents('php://input'), true);
    if (!isset($data['name']) || !isset($data['email'])) {
      http_response_code(400);
      echo json_encode(['error' => 'Invalid input']);
      return;
    }
    try {
      $this->userModel->updateUser($id, $data);
      http_response_code(200);
      echo json_encode(['message' => "User with ID $id updated successfully"]);
    } catch (\Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
  }

}
