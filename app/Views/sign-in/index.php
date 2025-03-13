<?php 
  include_once "header.php"; 
?>
<main class="form-signin w-100 m-auto">
  <form class="needs-validation" novalidate action="sign-in" method="post">
    <img class="mb-4" src="<?= BASE_URL . "/images/brand.png" ?>" alt="" width="300" height="150">
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <?php if (isset($_SESSION["error"])): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle-fill"></i> <?= $_SESSION["error"] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php unset($_SESSION["error"]) ?>
    <?php endif; ?>

    <div class="form-floating">
      <input type="email" class="form-control" id="email-address" name="email-address" placeholder="Email address" required>
      <label for="email-address">Email address</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
      <label for="password">Password</label>
    </div>

    <div class="form-check text-start my-3">
      <input class="form-check-input" type="checkbox" value="remember-me" id="flexCheckDefault">
      <label class="form-check-label" for="flexCheckDefault">
        Remember me
      </label>
    </div>
    <button class="btn btn-primary w-100 py-2" type="submit" name="sign-in-submit">Sign in</button>
    <p class="mt-5 mb-3 text-body-secondary">&copy; 2017–2024</p>
  </form>
</main>

<script src="<?= BASE_URL . "/js/form-validation.js" ?>"></script>

<?php include_once "footer.php" ?>