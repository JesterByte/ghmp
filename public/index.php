<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../config/constants.php";

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('GET', '/sign-in', ['App\Controllers\HomeController', 'index']);
    $r->addRoute('POST', '/sign-in', ['App\Controllers\AuthController', 'signIn']);
    $r->addRoute('POST', '/sign-out', ['App\Controllers\AuthController', 'signOut']);
    $r->addRoute('GET', '/dashboard', ['App\Controllers\DashboardController', 'index']);
    $r->addRoute('GET', '/phase-pricing', ['App\Controllers\PhasePricingController', 'index']);
    $r->addRoute('POST', '/phase-pricing', ['App\Controllers\PhasePricingController', 'setPrice']);
    $r->addRoute('POST', '/phase-rates', ['App\Controllers\PhasePricingController', 'setRates']);
    $r->addRoute('GET', '/estate-pricing', ['App\Controllers\EstatePricingController', 'index']);
    $r->addRoute('POST', '/estate-pricing', ['App\Controllers\EstatePricingController', 'setPrice']);
    $r->addRoute('POST', '/estate-rates', ['App\Controllers\EstatePricingController', 'setRates']);
    $r->addRoute("GET", "/map", ['App\Controllers\MapController', 'index']);
    $r->addRoute("GET", "/fetch-lots", ['App\Controllers\MapController', 'fetchLots']);
    $r->addRoute("GET", "/reservation-requests", ['App\Controllers\ReservationRequestsController', 'index']);
    $r->addRoute("GET", "/lot-reservations", ['App\Controllers\LotReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/lot-reservations-cash-sale", ['App\Controllers\LotReservationsController', 'indexCashSale']);
    $r->addRoute("GET", "/lot-reservations-six-months", ['App\Controllers\LotReservationsController', 'indexSixMonths']);
    $r->addRoute("GET", "/lot-reservations-installment", ['App\Controllers\LotReservationsController', 'indexInstallments']);
    $r->addRoute('POST', '/add-reservation', ['App\Controllers\LotReservationsController', 'setReservation']);
    $r->addRoute("GET", "/cash-sales", ['App\Controllers\CashSalesController', 'index']);
    $r->addRoute("POST", "/add-cash-sale-payment", ['App\Controllers\CashSalesController', 'setPayment']);
    $r->addRoute("GET", "/six-months", ['App\Controllers\SixMonthsController', 'index']);
    $r->addRoute("POST", "/add-six-months-payment", ['App\Controllers\SixMonthsController', 'setPayment']);
    $r->addRoute("GET", "/installments", ['App\Controllers\InstallmentsController', 'index']);
    $r->addRoute("POST", "/add-down-payment", ['App\Controllers\InstallmentsController', 'setDownPayment']);
    $r->addRoute("POST", "/add-monthly-payment", ['App\Controllers\InstallmentsController', 'setMonthlyPayment']);
    $r->addRoute("GET", "/fully-paids", ['App\Controllers\FullyPaidsController', 'indexCashSale']);
    $r->addRoute("GET", "/fully-paids-cash-sale", ['App\Controllers\FullyPaidsController', 'indexCashSale']);
    $r->addRoute("GET", "/fully-paids-six-months", ['App\Controllers\FullyPaidsController', 'indexSixMonths']);
    $r->addRoute("GET", "/fully-paids-installment", ['App\Controllers\FullyPaidsController', 'indexInstallment']);
    $r->addRoute("GET", "/backup-and-restore", ['App\Controllers\BackupAndRestoreController', 'index']);
    $r->addRoute("GET", "/backup-database", ['App\Controllers\BackupAndRestoreController', 'backupDatabase']);
    $r->addRoute("POST", "/restore-database", ['App\Controllers\BackupAndRestoreController', 'restoreDatabase']);
    $r->addRoute("GET", "/undo-restore", ['App\Controllers\BackupAndRestoreController', 'undoRestore']);
    $r->addRoute("POST", "/update-backup-time", ['App\Controllers\BackupAndRestoreController', 'updateBackupTime']);


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
        [$class, $method] = $routeInfo[1];
        call_user_func([new $class, $method]);
        break;
}