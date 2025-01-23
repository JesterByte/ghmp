<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class UserModel extends Model {
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getUserById($userId) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($password, $hashedPassword): bool {
        return password_verify($password, $hashedPassword);
    }

    public function createUser(string $email, string $password): bool {
        $stmt = $this->db->prepare("INSERT INTO users (email, password_hash) VALUES (:email, :password)");
        return $stmt->execute(['email' => $email, 'password' => $password]);
    }
}