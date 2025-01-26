<?php 
    use App\Helpers\DisplayHelper;
?>
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarMenuLabel">GHMP</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Dashboard", "active text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Dashboard", "aria-current='page'") ?> href="dashboard">
                    <i class="bi bi-speedometer2"></i>                
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Map", "active text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Map", "aria-current='page'") ?> href="map">
                    <i class="bi bi-map<?= DisplayHelper::isActivePage($pageTitle, "Map", "-fill") ?>"></i>                
                    Map
                </a>
            </li>
            <?php $lotPricingList = ["Reservation Requests", "Lot Reservations"]; ?>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reservationsSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "true", "false") ?>" aria-controls="reservationsSubmenu">
                    <i class="bi bi-calendar<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i> Reservations <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i>
                </a>
                <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "show") ?>" id="reservationsSubmenu">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="reservation-requests" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Reservation Requests", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Reservation Requests", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Reservation Requests", "-fill") ?>"></i> Reservation Requests</a></li>
                        <li><a href="lot-reservations" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Lot Reservations", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Lot Reservations", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Lot Reservations", "-fill") ?>"></i> Lot Reservations</a></li>
                    </ul>
                </div>
            </li>
            <?php $lotPricingList = ["Phase Pricing List", "Estate Pricing List"]; ?>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#lotPricingSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "true", "false") ?>" aria-controls="lotPricingSubmenu">
                    <i class="bi bi-tag<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i> Pricing <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i>
                </a>
                <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "show") ?>" id="lotPricingSubmenu">
                    <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                        <li><a href="phase-pricing" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "-fill") ?>"></i> Phase Pricing List</a></li>
                        <li><a href="estate-pricing" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "-fill") ?>"></i> Estate Pricing List</a></li>

                    </ul>
                </div>
            </li>
        </ul>
        <hr class="my-3">
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-gear"></i>                
                    Settings
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#" role="button" data-bs-toggle="modal" data-bs-target="#sign-out-modal">
                    <i class="bi bi-door-closed"></i>                
                    Sign out
                </a>
            </li>
        </ul>
        </div>
    </div>
</div>