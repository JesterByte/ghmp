<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Helpers\DisplayHelper;

class AuthController extends BaseController {
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
                
                $middleName = !empty($user["middle_name"]) ? " " . $user["middle_name"] . " " : " ";
                $suffixName = !empty($user["suffix_name"]) ? ", " . $user["suffix_name"] : "";
                $fullName = $user["first_name"] . $middleName . $user["last_name"] . $suffixName;

                $_SESSION["user_full_name"] = $fullName;
                $_SESSION["user_email"] = $user["email"];
                
                $_SESSION["user_first_name"] = $user["first_name"];
                $_SESSION["user_middle_name"] = $user["middle_name"];
                $_SESSION["user_last_name"] = $user["last_name"];
                $_SESSION["user_suffix_name"] = $user["suffix_name"];


                // header("Location: " . BASE_URL . "/dashboard");
                // exit();
                $this->redirect(BASE_URL . "/dashboard", DisplayHelper::$checkIcon, "Welcome, $fullName!", "Signin Successful");
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