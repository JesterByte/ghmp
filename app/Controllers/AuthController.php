<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Helpers\DisplayHelper;

class AuthController extends BaseController
{
    public function signIn()
    {
        $pageTitle = "Home";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $email = $_POST["email-address"];
            $password = $_POST["password"];
            $rememberMe = isset($_POST["remember-me"]);

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($email);

            if ($user && password_verify($password, $user["password_hash"])) {
                // Login successful
                session_start();
                $_SESSION["user_id"] = $user["id"];

                // Handle remember me
                if ($rememberMe) {
                    $token = $userModel->createRememberToken($user["id"]);
                    if ($token) {
                        setcookie(
                            'remember_token',
                            $token,
                            [
                                'expires' => time() + (30 * 24 * 60 * 60),
                                'path' => '/',
                                'secure' => true,
                                'httponly' => true,
                                'samesite' => 'Strict'
                            ]
                        );
                    }
                }

                $middleName = !empty($user["middle_name"]) ? " " . $user["middle_name"] . " " : " ";
                $suffixName = !empty($user["suffix_name"]) ? ", " . $user["suffix_name"] : "";
                $fullName = $user["first_name"] . $middleName . $user["last_name"] . $suffixName;

                $_SESSION["user_full_name"] = $fullName;
                $_SESSION["user_email"] = $user["email"];
                $_SESSION["user_first_name"] = $user["first_name"];
                $_SESSION["user_middle_name"] = $user["middle_name"];
                $_SESSION["user_last_name"] = $user["last_name"];
                $_SESSION["user_suffix_name"] = $user["suffix_name"];

                $this->redirect(BASE_URL . "/dashboard", DisplayHelper::$checkIcon, "Welcome, $fullName!", "Signin Successful");
            } else {
                $_SESSION["error"] = "Invalid email or password";
                header("Location: " . BASE_URL . "/sign-in");
                exit();
            }
        } else {
            header("Location: " . BASE_URL . "/sign-in");
            exit();
        }
    }

    public function signOut()
    {
        session_start();
        
        // Invalidate remember me token if exists
        if (isset($_COOKIE['remember_token'])) {
            $userModel = new UserModel();
            $userModel->invalidateRememberToken($_COOKIE['remember_token']);
            
            setcookie('remember_token', '', [
                'expires' => time() - 3600,
                'path' => '/',
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict'
            ]);
        }

        session_destroy();
        header("Location: " . BASE_URL . "/sign-in");
        exit();
    }

    public function autoLogin()
    {
        if (!isset($_SESSION['user_id']) && isset($_COOKIE['remember_token'])) {
            $userModel = new UserModel();
            $userId = $userModel->validateRememberToken($_COOKIE['remember_token']);
            
            if ($userId) {
                $user = $userModel->getUserById($userId);
                if ($user) {
                    session_start();
                    $_SESSION["user_id"] = $user["id"];
                    $_SESSION["user_full_name"] = $user["first_name"] . " " . $user["last_name"];
                    $_SESSION["user_email"] = $user["email"];
                    // Set other session variables as needed
                    return true;
                }
            }
        }
        return false;
    }
}
