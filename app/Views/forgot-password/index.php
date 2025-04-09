<?php
include_once "header.php";
?>
<main class="form-signin w-100 m-auto">
    <form class="needs-validation" novalidate action="forgot-password" method="post">
        <img class="mb-4" src="<?= BASE_URL . "/images/brand.png" ?>" alt="" width="300" height="150">
        <h1 class="h3 mb-3 fw-normal">Reset Password</h1>

        <?php if (isset($_SESSION["error"])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i> <?= $_SESSION["error"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["error"]) ?>
        <?php endif; ?>

        <?php if (isset($_SESSION["success"])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill"></i> <?= $_SESSION["success"] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION["success"]) ?>
        <?php endif; ?>

        <div class="form-floating">
            <input type="email" class="form-control" id="email-address" name="email-address" placeholder="Email address" required>
            <label for="email-address">Email address</label>
        </div>

        <button class="btn btn-primary w-100 py-2 mt-3" type="submit" name="forgot-password-submit">Reset Password</button>
        <a href="<?= BASE_URL ?>/sign-in" class="btn btn-link w-100">Back to Sign In</a>
    </form>
</main>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<?php include_once "footer.php" ?>