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

    public function updateUserProfile($data) {
        $stmt = $this->db->prepare("UPDATE users SET first_name = :first_name, middle_name = :middle_name, last_name = :last_name, suffix_name = :suffix_name, email = :email WHERE id = :id");
        return $stmt->execute([
            ':first_name' => $data['first_name'],
            ':middle_name' => $data['middle_name'],
            ':last_name' => $data['last_name'],
            ':suffix_name' => $data['suffix_name'],
            ':email' => $data['email'],
            ':id' => $_SESSION["user_id"]
        ]);
    }

    public function updateUserPassword($userId, $newPassword) {
        $stmt = $this->db->prepare("UPDATE users SET password_hash = :password WHERE id = :id");
        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id' => $userId
        ]);
    }
}