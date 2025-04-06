<!-- Profile Card -->
<div class="card mb-4 shadow">
    <div class="card-header">
        <strong>Profile Information</strong>
    </div>
    <div class="card-body">
        <form id="profileForm" action="<?= BASE_URL ?>/account-settings/update" method="POST" class="needs-validation" novalidate>
            <!-- First Name -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" value="<?= $user['first_name'] ?? '' ?>" required>
                <label for="first_name">First Name</label>
            </div>

            <!-- Middle Name -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Middle Name (Optional)" value="<?= $user['middle_name'] ?? '' ?>">
                <label for="middle_name">Middle Name (Optional)</label>
            </div>

            <!-- Last Name -->
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" value="<?= $user['last_name'] ?? '' ?>" required>
                <label for="last_name">Last Name</label>
            </div>

            <!-- Suffix -->
            <div class="form-floating mb-3">
                <select name="suffix" id="suffix" class="form-select">
                    <option value=""></option>
                    <option value="Sr.">Sr.</option>
                    <option value="Jr.">Jr.</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                </select>
                <label for="suffix">Suffix (Optional)</label>
            </div>

            <!-- Email -->
            <div class="form-floating mb-3">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" value="<?= $user['email'] ?>" required>
                <label for="email">Email Address</label>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmUpdateProfileModal">
                    Update Profile
                </button>
                <a href="#changePasswordCollapse" data-bs-toggle="collapse" class="btn btn-outline-secondary">Change Password</a>
            </div>
        </form>
    </div>
</div>

<!-- Change Password -->
<div class="card collapse" id="changePasswordCollapse">
    <div class="card-header">
        <strong>Change Password</strong>
    </div>
    <div class="card-body">
        <form id="passwordForm" action="<?= BASE_URL ?>/account-settings/change-password" method="POST" class="needs-validation" novalidate>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="current_password" id="current_password" placeholder="Current Password" required>
                <label for="current_password">Current Password</label>
            </div>
            <!-- New Password -->
            <div class="form-floating mb-1">
                <input type="password"
                    class="form-control"
                    name="new_password"
                    id="new_password"
                    placeholder="New Password"
                    required
                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9_]).{8,}$"
                    title="Must be at least 8 characters long, contain uppercase, lowercase, a number, and a special character (no underscores)">
                <label for="new_password">New Password</label>
            </div>
            <small class="text-muted ms-2 mb-3 d-block">
                Password must be at least 8 characters long and include uppercase, lowercase, a number, and a special character. Underscore (_) is not allowed.
            </small>

            <!-- Confirm Password -->
            <div class="form-floating mb-3">
                <input type="password"
                    class="form-control"
                    name="confirm_password"
                    id="confirm_password"
                    placeholder="Confirm Password"
                    required>
                <label for="confirm_password">Confirm Password</label>
                <small id="passwordHelp" class="text-danger ms-2 d-none">
                    Passwords do not match.
                </small>
            </div>

            <button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#confirmUpdatePasswordModal">Update Password</button>
        </form>
    </div>
</div>

<?php include_once VIEW_PATH . "/modals/modal-confirm-update-profile.php" ?>
<?php include_once VIEW_PATH . "/modals/modal-confirm-update-password.php" ?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const newPassword = document.getElementById("new_password");
        const confirmPassword = document.getElementById("confirm_password");

        confirmPassword.addEventListener("input", () => {
            const helpText = document.getElementById("passwordHelp");
            if (confirmPassword.value !== newPassword.value) {
                confirmPassword.setCustomValidity("Passwords do not match.");
                helpText.classList.remove("d-none");
            } else {
                confirmPassword.setCustomValidity("");
                helpText.classList.add("d-none");
            }
        });


        newPassword.addEventListener("input", () => {
            // Also re-check when new password changes
            if (confirmPassword.value !== "") {
                confirmPassword.dispatchEvent(new Event("input"));
            }
        });
    });
</script>