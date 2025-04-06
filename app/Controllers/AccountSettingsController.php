<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\DisplayHelper;
use App\Models\UserModel;
use App\Utils\Formatter;

class AccountSettingsController extends BaseController
{
    public function index()
    {
        $this->checkSession();

        $data = [
            "pageTitle" => "Account Settings",
            "usesDataTables" => false,
            "phasePricingTable" => [],
            "view" => "account-settings/index",

            "userId" => $_SESSION["user_id"],
            "user" => [
                "first_name" => $_SESSION["user_first_name"],
                "middle_name" => $_SESSION["user_middle_name"],
                "last_name" => $_SESSION["user_last_name"],
                "suffix" => $_SESSION["user_suffix_name"],
                "email" => $_SESSION["user_email"]
            ],

            "pendingBurialReservations" => $this->pendingBurialReservations,
            "pendingLotReservations" => $this->pendingLotReservations,
            "pendingEstateReservations" => $this->pendingEstateReservations,
            "pendingReservations" => $this->pendingReservations,
            "pendingInquiries" => $this->pendingInquiries
        ];

        View::render("templates/layout", $data);
    }

    public function updateProfile()
    {
        $this->checkSession();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $firstName = Formatter::cleanName($_POST["first_name"]);
            $middleName = Formatter::cleanName($_POST["middle_name"]);
            $lastName = Formatter::cleanName($_POST["last_name"]);
            $suffix = !empty($_POST["suffix"]) && Formatter::validateSuffix($_POST["suffix"]) ? Formatter::cleanName($_POST["suffix"]) : "";

            $email = Formatter::cleanEmail($_POST["email"]);

            $data = [
                "first_name" => $firstName,
                "middle_name" => $middleName,
                "last_name" => $lastName,
                "suffix_name" => $suffix,
                "email" => $email
            ];

            $userModel = new UserModel();
            $isUpdated = $userModel->updateUserProfile($data);
            if ($isUpdated) {
                $_SESSION["user_first_name"] = $firstName;
                $_SESSION["user_middle_name"] = $middleName;
                $_SESSION["user_last_name"] = $lastName;
                $_SESSION["user_suffix_name"] = $suffix;
                $_SESSION["user_email"] = $email;

                // Redirect to the same page to avoid resubmission
                $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$checkIcon, "Profile updated successfully.", "Operation Successful");
            } else {
                // Handle error (e.g., show an error message)
                $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$xIcon, "Failed to update profile.", "Operation Failed");
            }
        }
    }

    public function updatePassword() {
        $this->checkSession();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $currentPassword = trim($_POST["current_password"]);
            $newPassword = trim($_POST["new_password"]);
            $confirmPassword = trim($_POST["confirm_password"]);

            $userId = $_SESSION["user_id"];
            $userModel = new UserModel();
            $user = $userModel->getUserById($userId);
            if ($user) {
                // Verify the current password
                if ($userModel->verifyPassword($currentPassword, $user["password_hash"])) {
                    // Check if new password and confirm password match
                    if ($newPassword === $confirmPassword) {
                        // Update the password
                        $isUpdated = $userModel->updateUserPassword($userId, $newPassword);
                        if ($isUpdated) {
                            // Redirect to the same page to avoid resubmission
                            $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$checkIcon, "Password updated successfully.", "Operation Successful");
                        } else {
                            // Handle error (e.g., show an error message)
                            $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$xIcon, "Failed to update password.", "Operation Failed");
                        }
                    } else {
                        // Handle error (e.g., show an error message)
                        $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$xIcon, "New password and confirmation do not match.", "Operation Failed");
                    }
                } else {
                    // Handle error (e.g., show an error message)
                    $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$xIcon, "Current password is incorrect.", "Operation Failed");
                }
            } else {
                // Handle error (e.g., show an error message)
                $this->redirect(BASE_URL . "/account-settings", DisplayHelper::$xIcon, "User not found.", "Operation Failed");
            }
        }
    }
}
