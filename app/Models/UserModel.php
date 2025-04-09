<?php

namespace App\Models;

use App\Core\Model;
use PDO;

class UserModel extends Model
{
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }

    public function getUserById($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($password, $hashedPassword): bool
    {
        return password_verify($password, $hashedPassword);
    }

    public function createUser(string $email, string $password): bool
    {
        $stmt = $this->db->prepare("INSERT INTO users (email, password_hash) VALUES (:email, :password)");
        return $stmt->execute(['email' => $email, 'password' => $password]);
    }

    public function updateUserProfile($data)
    {
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

    public function updateUserPassword($userId, $newPassword)
    {
        $stmt = $this->db->prepare("UPDATE users SET password_hash = :password WHERE id = :id");
        return $stmt->execute([
            ':password' => password_hash($newPassword, PASSWORD_BCRYPT),
            ':id' => $userId
        ]);
    }

    public function createRememberToken($userId)
    {
        $token = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));

        $stmt = $this->db->prepare("INSERT INTO remember_tokens (user_id, token, expiry) VALUES (:user_id, :token, :expiry)");
        $success = $stmt->execute([
            ':user_id' => $userId,
            ':token' => $token,
            ':expiry' => $expiry
        ]);

        return $success ? $token : null;
    }

    public function validateRememberToken($token)
    {
        $stmt = $this->db->prepare("
            SELECT user_id 
            FROM remember_tokens 
            WHERE token = :token 
            AND expiry > NOW() 
            AND is_valid = 1
        ");

        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function invalidateRememberToken($token)
    {
        $stmt = $this->db->prepare("
            UPDATE remember_tokens 
            SET is_valid = 0 
            WHERE token = :token
        ");

        return $stmt->execute([':token' => $token]);
    }

    public function cleanupExpiredTokens()
    {
        $stmt = $this->db->prepare("
            DELETE FROM remember_tokens 
            WHERE expiry < NOW() 
            OR is_valid = 0
        ");

        return $stmt->execute();
    }

    public function createPasswordResetToken($userId, $token, $expiry)
    {
        $stmt = $this->db->prepare("
            INSERT INTO password_resets (user_id, token, expiry)
            VALUES (:user_id, :token, :expiry)
        ");

        return $stmt->execute([
            ':user_id' => $userId,
            ':token' => $token,
            ':expiry' => $expiry
        ]);
    }

    public function validateResetToken($token)
    {
        $stmt = $this->db->prepare("
            SELECT user_id 
            FROM password_resets 
            WHERE token = :token 
            AND expiry > NOW() 
            AND used = 0
        ");

        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function markResetTokenUsed($token)
    {
        $stmt = $this->db->prepare("
            UPDATE password_resets 
            SET used = 1 
            WHERE token = :token
        ");

        return $stmt->execute([':token' => $token]);
    }

    public function createPasswordResetOTP($userId, $otp, $expiry)
    {
        $stmt = $this->db->prepare("
            INSERT INTO password_resets (user_id, otp, expiry)
            VALUES (:user_id, :otp, :expiry)
        ");

        return $stmt->execute([
            ':user_id' => $userId,
            ':otp' => $otp,
            ':expiry' => $expiry
        ]);
    }

    public function verifyOTP($userId, $otp)
    {
        $stmt = $this->db->prepare("
            SELECT id FROM password_resets 
            WHERE user_id = :user_id 
            AND otp = :otp 
            AND expiry > NOW() 
            AND used = 0
        ");

        $stmt->execute([
            ':user_id' => $userId,
            ':otp' => $otp
        ]);

        return $stmt->fetch(PDO::FETCH_COLUMN) ? true : false;
    }

    public function markOTPUsed($otp)
    {
        $stmt = $this->db->prepare("
            UPDATE password_resets 
            SET used = 1 
            WHERE otp = :otp
        ");

        return $stmt->execute([':otp' => $otp]);
    }
}
