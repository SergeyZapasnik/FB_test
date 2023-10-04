<?php

require_once '../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\CurrencyController;
use App\Controllers\AdminController;
use Containers\Container;

$routes = [
    '/' => [CurrencyController::class, 'conversion'], // Root route for currency conversion
    '/convert' => [CurrencyController::class, 'convert'], // Root route for currency conversion
    '/admin' => [AdminController::class, 'index'], // Admin panel route
];

// Get the current URL request
$currentUrl = $_SERVER['REQUEST_URI'];

// Check if there is a matching route for the current URL
if (array_key_exists($currentUrl, $routes)) {
    // Get the controller and method information for handling the route
    list($controllerName, $method) = $routes[$currentUrl];

    try {
        // Create an instance of the controller
        $controller = (new Container())->get($controllerName);
        // Call the specified method on the controller instance
        $controller->$method();
    } catch (ReflectionException $e) {
        //TODO Exception Handling
        echo 'Error: ' . $e->getMessage();
    }
} else {
    echo '404 - Page Not Found';
}