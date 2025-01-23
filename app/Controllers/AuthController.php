<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController {
    public function signIn() {
        $pageTitle = "Home";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email-address"];
            $password = $_POST["password"];

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user["password_hash"])) {
                // Login successful
                session_start();
                $_SESSION["user_id"] = $user["id"];

                header("Location: " . BASE_URL . "/dashboard");
                exit();
            } else {
                // Login failed
                $_SESSION["error"] = "Invalid email or password";
                header("Location: " . BASE_URL . "/sign-in");
                exit();
            }
        } else {
            header("Location: " . BASE_URL . "/sign-in");
            exit();
        }
    }

    public function signOut() {
        session_start();
        session_destroy();
        
        header("Location: " . BASE_URL . "/sign-in");
        exit();
    }
}