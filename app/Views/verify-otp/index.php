<?php include_once "header.php"; ?>

<main class="form-signin w-100 m-auto">
    <form class="needs-validation" novalidate action="<?= BASE_URL ?>/verify-otp/verify" method="post">
        <img class="mb-4" src="<?= BASE_URL . "/images/brand.png" ?>" alt="" width="300" height="150">
        <h1 class="h3 mb-3 fw-normal">Verify OTP</h1>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i> <?= $_SESSION["error"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["error"]) ?>
        <?php endif; ?>

        <p class="text-muted">Enter the OTP sent to <?= htmlspecialchars($email) ?></p>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="otp" name="otp" 
                   placeholder="Enter OTP" required pattern="[0-9]{6}" maxlength="6">
            <label for="otp">OTP Code</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="new_password" name="new_password" 
                   placeholder="New password" required minlength="8">
            <label for="new_password">New Password</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" 
                   placeholder="Confirm password" required minlength="8">
            <label for="confirm_password">Confirm Password</label>
        </div>

        <button class="btn btn-primary w-100 py-2" type="submit" name="verify-otp-submit">Reset Password</button>
        <a href="<?= BASE_URL ?>/forgot-password" class="btn btn-link w-100">Back</a>
    </form>
</main>

<?php include_once "footer.php" ?>