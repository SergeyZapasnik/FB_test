<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Cron\CurrencyUpdater;
use Containers\Container;

try {
    $currencyUpdater = (new Container())->get(CurrencyUpdater::class);
    $currencyUpdater->run();
} catch (ReflectionException $e) {
    //TODO Exception Handling
    echo 'Error: ' . $e->getMessage();
}