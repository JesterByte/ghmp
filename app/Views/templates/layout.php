<?php include_once "dashboard-header.php" ?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"><?= $pageTitle ?></h1>
    </div>
    <?= $content; ?>
    <!-- Content goes here -->
</main>
<?php include_once VIEW_PATH . "/modals/modal-sign-out.php" ?>
<?php include_once "dashboard-footer.php" ?>