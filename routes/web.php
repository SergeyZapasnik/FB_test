<?php

require_once 'vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\CurrencyController;
use App\Controllers\AdminController;

$routes = [
    '/' => [CurrencyController::class, 'conversion'], // Root route for currency conversion
    '/update-currencies' => [CurrencyController::class, 'updateCurrencies'], // Update currency rates route
    '/login' => [AuthController::class, 'login'], // Login page route
    '/process-login' => [AuthController::class, 'processLogin'], // Login form processing route
    '/logout' => [AuthController::class, 'logout'], // Logout route
    '/admin' => [AdminController::class, 'index'], // Admin panel route
    '/admin/conversion' => [AdminController::class, 'conversion'], // Admin conversion page route
];

// Get the current URL request
$currentUrl = $_SERVER['REQUEST_URI'];

// Check if there is a matching route for the current URL
if (array_key_exists($currentUrl, $routes)) {
    // Get the controller and method information for handling the route
    list($controllerName, $method) = $routes[$currentUrl];

    // Create an instance of the controller and call the method
    $controllerInstance = new $controllerName();
    $controllerInstance->$method();
} else {
    echo '404 - Page Not Found';
}