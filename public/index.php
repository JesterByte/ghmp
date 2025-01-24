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