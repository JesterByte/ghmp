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
                <?php $reservationsList = ["Burial Reservations", "Burial Reservation Requests", "Lot Reservations", "Lot Reservation Requests", "Estate Reservations", "Estate Reservation Requests"]; ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#reservationsSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $reservationsList, "true", "false") ?>" aria-controls="reservationsSubmenu">
                        <i class="bi bi-calendar<?= DisplayHelper::isPageInList($pageTitle, $reservationsList, "-fill") ?>"></i> Reservations <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $reservationsList, "-fill") ?>"></i>
                    </a>
                    <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $reservationsList, "show") ?>" id="reservationsSubmenu">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li>
                                <a href="<?= BASE_URL . "/burial-reservations" ?>" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isPageInList($pageTitle, ["Burial Reservations", "Burial Reservation Requests"], "-fill text-bg-primary") ?>" <?= DisplayHelper::isPageInList($pageTitle, ["Burial Reservations", "Burial Reservation Requests"], "aria-current='page'") ?>>
                                    <i class="bi bi-caret-right<?= DisplayHelper::isPageInList($pageTitle, ["Burial Reservations", "Burial Reservation Requests"], "-fill") ?>"></i>
                                    Burial Reservations

                                    <?php if ($pendingBurialReservations != 0): ?>
                                        <span class="badge text-bg-danger"><?= $pendingBurialReservations ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>

                            <li>
                                <a href="<?= BASE_URL . "/lot-reservations" ?>" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isPageInList($pageTitle, ["Lot Reservations", "Lot Reservation Requests"], "-fill text-bg-primary") ?>" <?= DisplayHelper::isPageInList($pageTitle, ["Lot Reservations", "Lot Reservation Requests"], "aria-current='page'") ?>>
                                    <i class="bi bi-caret-right<?= DisplayHelper::isPageInList($pageTitle, ["Lot Reservations", "Lot Reservation Requests"], "-fill") ?>"></i>
                                    Lot Reservations

                                    <?php if ($pendingLotReservations != 0): ?>
                                        <span class="badge text-bg-danger"><?= $pendingLotReservations ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?= BASE_URL . "/estate-reservations" ?>" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isPageInList($pageTitle, ["Estate Reservations", "Estate Reservation Requests"], "-fill text-bg-primary") ?>" <?= DisplayHelper::isPageInList($pageTitle, ["Estate Reservations", "Estate Reservation Requests"], "aria-current='page'") ?>>
                                    <i class="bi bi-caret-right<?= DisplayHelper::isPageInList($pageTitle, ["Estate Reservations", "Estate Reservation Requests"], "-fill") ?>"></i>
                                    Estate Reservations

                                    <?php if ($pendingEstateReservations != 0): ?>
                                        <span class="badge text-bg-danger"><?= $pendingEstateReservations ?></span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <?php $paymentsList = ["Cash Sales", "6 Months", "Installments", "Fully Paids"]; ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#paymentsSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $paymentsList, "true", "false") ?>" aria-controls="paymentsSubmenu">
                        <i class="bi bi-credit-card<?= DisplayHelper::isPageInList($pageTitle, $paymentsList, "-fill") ?>"></i> Payments <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $paymentsList, "-fill") ?>"></i>
                    </a>
                    <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $paymentsList, "show") ?>" id="paymentsSubmenu">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="cash-sales" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Cash Sales", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Cash Sales", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Cash Sales", "-fill") ?>"></i> Cash Sales</a></li>
                            <li><a href="six-months" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "6 Months", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "6 Months", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "6 Months", "-fill") ?>"></i> 6 Months</a></li>
                            <li><a href="installments" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Installments", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Installments", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Installments", "-fill") ?>"></i> Installments</a></li>
                            <li><a href="fully-paids" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Fully Paids", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Fully Paids", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Fully Paids", "-fill") ?>"></i> Fully Paids</a></li>

                        </ul>
                    </div>
                </li>
                <?php $lotPricingList = ["Burial Pricing List", "Phase Pricing List", "Estate Pricing List"]; ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#lotPricingSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "true", "false") ?>" aria-controls="lotPricingSubmenu">
                        <i class="bi bi-tag<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i> Pricing <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i>
                    </a>
                    <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "show") ?>" id="lotPricingSubmenu">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="burial-pricing" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Burial Pricing List", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Burial Pricing List", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Burial Pricing List", "-fill") ?>"></i> Burial Pricing List</a></li>
                            <li><a href="phase-pricing" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Phase Pricing List", "-fill") ?>"></i> Phase Pricing List</a></li>
                            <li><a href="estate-pricing" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Estate Pricing List", "-fill") ?>"></i> Estate Pricing List</a></li>

                        </ul>
                    </div>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="nav flex-column mb-auto">
                <?php $lotPricingList = ["Backup & Restore"]; ?>
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" data-bs-toggle="collapse" href="#settingsSubmenu" role="button" aria-expanded="<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "true", "false") ?>" aria-controls="settingsSubmenu">
                        <i class="bi bi-gear<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i> Settings <i class="bi bi-caret-down<?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "-fill") ?>"></i>
                    </a>
                    <div class="collapse <?= DisplayHelper::isPageInList($pageTitle, $lotPricingList, "show") ?>" id="settingsSubmenu">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="backup-and-restore" class="nav-link d-flex align-items-center gap-2 <?= DisplayHelper::isActivePage($pageTitle, "Backup & Restore", "-fill text-bg-primary") ?>" <?= DisplayHelper::isActivePage($pageTitle, "Backup & Restore", "aria-current='page'") ?>><i class="bi bi-caret-right<?= DisplayHelper::isActivePage($pageTitle, "Backup & Restore", "-fill") ?>"></i> Backup & Restore</a></li>

                        </ul>
                    </div>
                </li>
                <!-- <li class="nav-item">
                <a class="nav-link d-flex align-items-center gap-2" href="#">
                    <i class="bi bi-gear"></i>                
                    Settings
                </a>
            </li> -->
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