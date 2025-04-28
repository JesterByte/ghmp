<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../config/constants.php";

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('GET', '/sign-in', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('POST', '/sign-in', ['App\Controllers\AuthController', 'signIn']);

    $r->get('/forgot-password',  ["App\Controllers\ForgotPasswordController", "index"]);
    $r->post('/forgot-password', ["App\Controllers\ForgotPasswordController", "sendOTP"]);
    $r->get('/verify-otp', ["App\Controllers\VerifyOTPController", "index"]);
    $r->post('/verify-otp/verify', ["App\Controllers\VerifyOTPController", "verify"]);

    $r->addRoute('POST', '/sign-out', ['App\Controllers\AuthController', 'signOut']);

    $r->addRoute('GET', '/dashboard', ['App\Controllers\DashboardController', 'index']);

    $r->addRoute("GET", "/burial-pricing", ['App\Controllers\BurialPricingController', 'indexLot']);
    $r->addRoute("POST", "/burial-pricing", ['App\Controllers\BurialPricingController', 'updatePrice']);

    $r->addRoute("GET", "/burial-pricing-lot", ['App\Controllers\BurialPricingController', 'indexLot']);
    $r->addRoute("GET", "/burial-pricing-estate", ['App\Controllers\BurialPricingController', 'indexEstate']);


    $r->addRoute('GET', '/phase-pricing', ['App\Controllers\PhasePricingController', 'index']);
    $r->addRoute('POST', '/phase-pricing', ['App\Controllers\PhasePricingController', 'setPrice']);
    $r->addRoute('POST', '/phase-rates', ['App\Controllers\PhasePricingController', 'setRates']);
    $r->addRoute('GET', '/estate-pricing', ['App\Controllers\EstatePricingController', 'index']);
    $r->addRoute('POST', '/estate-pricing', ['App\Controllers\EstatePricingController', 'setPrice']);
    $r->addRoute('POST', '/estate-rates', ['App\Controllers\EstatePricingController', 'setRates']);

    $r->addRoute('GET', '/custom-payment-plans-lot', ['App\Controllers\CustomPaymentPlansController', 'indexLot']);
    $r->addRoute('POST', '/custom-payment-plans-lot/get-phase-price', ['App\Controllers\CustomPaymentPlansController', 'getPhasePrice']);

    $r->addRoute('GET', '/custom-payment-plans-estate', ['App\Controllers\CustomPaymentPlansController', 'indexEstate']);
    $r->addRoute('POST', '/custom-payment-plans-estate/get-estate-price', ['App\Controllers\CustomPaymentPlansController', 'getEstatePrice']);

    


    $r->addRoute('GET', '/collection-report', ['App\Controllers\CollectionReportController', 'index']);

    $r->addRoute('GET', '/collection-report/get-collections', ['App\Controllers\CollectionReportController', 'getCollections']);

    $r->addRoute("GET", "/map", ['App\Controllers\MapController', 'index']);
    $r->addRoute("GET", "/map-lots-list", ['App\Controllers\MapController', 'indexLotsList']);
    $r->addRoute("GET", "/map-estates-list", ['App\Controllers\MapController', 'indexEstatesList']);
    $r->addRoute("POST", "/update-lot-type", ['App\Controllers\MapController', 'updateLotType']);

    $r->addRoute("GET", "/fetch-lots", ['App\Controllers\MapController', 'fetchLots']);

    $r->addRoute("GET", "/deceased", ['App\Controllers\DeceasedController', 'index']);

    $r->addRoute("GET", "/inquiries", ['App\Controllers\InquiriesController', 'index']);
    $r->addRoute("POST", "/inquiries/reply", ['App\Controllers\InquiriesController', 'reply']);

    $r->addRoute("GET", "/restructure-requests", ['App\Controllers\RestructureRequestsController', 'index']);
    $r->addRoute("GET", "/restructure-requests/get-remaining-balance", ['App\Controllers\RestructureRequestsController', 'getRemainingBalance']);
    $r->addRoute("POST", "/restructure-request-confirmation", ['App\Controllers\RestructureRequestsController', 'requestAction']);

    $r->addRoute("GET", "/lot-reservation-requests", ['App\Controllers\LotReservationRequestsController', 'index']);
    $r->addRoute("POST", "/lot-reservation-confirmation", ['App\Controllers\LotReservationRequestsController', 'submitLotReservationConfirmation']);
    // $r->addRoute("GET", "/verify-lot-type/{lotId:[A-Za-z0-9\+\/=]+}/{reserveeId:[A-Za-z0-9\+\/=]+}", ['App\Controllers\LotReservationRequestsController', 'verifyLotType']);
    // $r->addRoute("POST", "/verify-lot-type-submit", ["App\Controllers\LotReservationRequestsController", "setLotType"]);
    // $r->addRoute("POST", "/lot-reservation-cancellation", ["App\Controllers\LotReservationRequestsController", "cancelLotReservation"]);

    $r->addRoute("GET", "/estate-reservation-requests", ['App\Controllers\EstateReservationRequestsController', 'index']);
    $r->addRoute("POST", "/estate-reservation-confirmation", ['App\Controllers\EstateReservationRequestsController', 'submitEstateReservationConfirmation']);

    $r->addRoute("GET", "/burial-reservations", ['App\Controllers\BurialReservationsController', 'index']);
    $r->addRoute("GET", "/burial-reservations/get-assets/{customerId}", ['App\Controllers\BurialReservationsController', 'getAssets']);
    $r->addRoute("GET", "/burial-reservations/get-burial-types/{assetType}", ['App\Controllers\BurialReservationsController', 'getBurialTypes']);
    $r->addRoute("GET", "/burial-reservations/get-events", ['App\Controllers\BurialReservationsController', 'getEvents']);
    $r->addRoute("GET", "/burial-reservation-requests", ['App\Controllers\BurialReservationRequestsController', 'index']);
    $r->addRoute("POST", "/burial-reservation-confirmation", ['App\Controllers\BurialReservationRequestsController', 'submitBurialReservationConfirmation']);
    $r->addRoute("POST", "/burial-reservations/mark-done", ['App\Controllers\BurialReservationsController', 'markDone']);
    $r->addRoute("POST", "/burial-reservations/add-reservation", ['App\Controllers\BurialReservationsController', 'setReservation']);
    $r->addRoute("POST", "/burial-reservations/update-settings", ['App\Controllers\BurialReservationsController', 'updateSettings']);

    $r->addRoute("GET", "/lot-reservations", ['App\Controllers\LotReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/lot-reservations-cash-sale", ['App\Controllers\LotReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/lot-reservations-six-months", ['App\Controllers\LotReservationsController', 'indexSixMonths']);
    $r->addRoute("GET", "/lot-reservations-installment", ['App\Controllers\LotReservationsController', 'indexInstallments']);
    $r->addRoute("GET", "/lot-reservations-cancelled", ['App\Controllers\LotReservationsController', 'indexCancelled']);
    $r->addRoute("GET", "/lot-reservations-overdue", ['App\Controllers\LotReservationsController', 'indexOverdue']);
    $r->addRoute("POST", "/lot-reservations/fetch-phase-pricing", ['App\Controllers\LotReservationsController', 'fetchPhasePricing']);
    $r->addRoute("POST", "/lot-reservations/update-settings", ['App\Controllers\LotReservationsController', 'updateSettings']);
    $r->addRoute("POST", "/lot-reservation-cancellation", ["App\Controllers\LotReservationsController", "cancelLotReservation"]);


    $r->addRoute('POST', '/add-reservation', ['App\Controllers\LotReservationsController', 'setReservation']);

    $r->addRoute("GET", "/estate-reservations", ['App\Controllers\EstateReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/estate-reservations-cash-sale", ['App\Controllers\EstateReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/estate-reservations-six-months", ['App\Controllers\EstateReservationsController', 'indexSixMonths']);
    $r->addRoute("GET", "/estate-reservations-installment", ['App\Controllers\EstateReservationsController', 'indexInstallments']);
    $r->addRoute("GET", "/estate-reservations-cancelled", ['App\Controllers\EstateReservationsController', 'indexCancelled']);
    $r->addRoute("GET", "/estate-reservations-overdue", ['App\Controllers\EstateReservationsController', 'indexOverdue']);
    $r->addRoute("POST", "/estate-reservations/fetch-estate-pricing", ['App\Controllers\EstateReservationsController', 'fetchEstatePricing']);
    $r->addRoute("POST", "/estate-reservations/update-settings", ['App\Controllers\EstateReservationsController', 'updateSettings']);

    $r->addRoute('POST', '/add-reservation-estate', ['App\Controllers\EstateReservationsController', 'setReservation']);

    $r->addRoute("GET", "/burials", ['App\Controllers\BurialsController', 'index']);

    $r->addRoute("GET", "/cash-sales", ['App\Controllers\CashSalesController', 'index']);
    $r->addRoute("POST", "/add-cash-sale-payment", ['App\Controllers\CashSalesController', 'setPayment']);

    $r->addRoute("GET", "/six-months", ['App\Controllers\SixMonthsController', 'index']);
    $r->addRoute("GET", "/six-months-down-payments", ['App\Controllers\SixMonthsController', 'indexDownPayments']);
    $r->addRoute("POST", "/six-months/reservee", ['App\Controllers\SixMonthsController', 'fetchReservee']);
    $r->addRoute("POST", "/record-six-months-payment", ['App\Controllers\SixMonthsController', 'setPayment']);

    $r->addRoute("GET", "/installments", ['App\Controllers\InstallmentsController', 'index']);
    $r->addRoute("GET", "/installments-down-payments", ['App\Controllers\InstallmentsController', 'indexDownPayments']);
    $r->addRoute("POST", "/installments/reservee", ['App\Controllers\InstallmentsController', 'fetchReservee']);
    $r->addRoute("POST", "/record-installment-payment", ['App\Controllers\InstallmentsController', 'setPayment']);


    $r->addRoute("POST", "/add-down-payment", ['App\Controllers\InstallmentsController', 'setDownPayment']);
    $r->addRoute("POST", "/add-monthly-payment", ['App\Controllers\InstallmentsController', 'setMonthlyPayment']);

    $r->addRoute("GET", "/fully-paids", ['App\Controllers\FullyPaidsController', 'indexCashSale']);
    $r->addRoute("GET", "/fully-paids-cash-sale", ['App\Controllers\FullyPaidsController', 'indexCashSale']);
    $r->addRoute("GET", "/fully-paids-six-months", ['App\Controllers\FullyPaidsController', 'indexSixMonths']);
    $r->addRoute("GET", "/fully-paids-installment", ['App\Controllers\FullyPaidsController', 'indexInstallment']);
    $r->addRoute("POST", "/issue-certificate", ['App\Controllers\FullyPaidsController', 'issueCertificate']);

    $r->addRoute("GET", "/account-settings", ['App\Controllers\AccountSettingsController', 'index']);
    $r->addRoute("POST", "/account-settings/update", ['App\Controllers\AccountSettingsController', 'updateProfile']);
    $r->addRoute("POST", "/account-settings/change-password", ['App\Controllers\AccountSettingsController', 'updatePassword']);

    $r->addRoute("GET", "/backup-and-restore", ['App\Controllers\BackupAndRestoreController', 'index']);
    $r->addRoute("GET", "/backup-database", ['App\Controllers\BackupAndRestoreController', 'backupDatabase']);
    $r->addRoute("POST", "/restore-database", ['App\Controllers\BackupAndRestoreController', 'restoreDatabase']);
    $r->addRoute("GET", "/undo-restore", ['App\Controllers\BackupAndRestoreController', 'undoRestore']);
    $r->addRoute("POST", "/update-backup-time", ['App\Controllers\BackupAndRestoreController', 'updateBackupTime']);

    $r->addRoute("GET", "/customers", ['App\Controllers\CustomersController', 'index']);
    $r->addRoute("POST", "/customers/action", ['App\Controllers\CustomersController', 'customerAction']);
    $r->addRoute("GET", "/fetch-beneficiaries/{customerId}", ["App\Controllers\CustomersController", "fetchBeneficiaries"]);

    // $r->addRoute("GET", "/notification/fetchNotifications/{adminId}", ['App\Controllers\NotificationController', 'fetchNotifications/$1']);
    // $r->addRoute("GET", "/notification/markAsRead/{notificationId}", ['App\Controllers\NotificationController', 'markAsRead/$1']);
    // $r->addRoute("GET", "/notification/markAllAsRead/{adminId}", ['App\Controllers\NotificationController', 'markAllAsRead/$1']);

    $r->addRoute("GET", "/notification/fetchNotifications/{adminId}", ['App\Controllers\NotificationController', 'fetchNotifications']);
    $r->addRoute("GET", "/notification/markAsRead/{notificationId}", ['App\Controllers\NotificationController', 'markAsRead']);
    $r->addRoute("GET", "/notification/markAllAsRead/{adminId}", ['App\Controllers\NotificationController', 'markAllAsRead']);

    // $r->addRoute("GET", "/notification/fetchNotifications/{adminId}", 'App\Controllers\NotificationController@fetchNotifications');
    // $r->addRoute("GET", "/notification/markAsRead/{notificationId}", 'App\Controllers\NotificationController@markAsRead');
    // $r->addRoute("GET", "/notification/markAllAsRead/{adminId}", 'App\Controllers\NotificationController@markAllAsRead');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
// Remove the '/ghmp/public' prefix if it exists (for local setup)
$uri = preg_replace('#^/ghmp/public#', '', $uri);
$uri = strtok($uri, '?');

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
// var_dump($routeInfo); // Print out the route information for debugging
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo '404 Not Found';
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        // Get the handler (controller and method) and route parameters
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];

        // Assuming handler is in the form of ['App\Controllers\ClassName', 'methodName']
        list($controller, $method) = $handler;

        // Call the controller method, passing the parameters
        call_user_func_array([new $controller, $method], $vars);
        break;
        // case FastRoute\Dispatcher::FOUND:
        //     [$class, $method] = $routeInfo[1];
        //     call_user_func([new $class, $method]);
        //     break;
}
