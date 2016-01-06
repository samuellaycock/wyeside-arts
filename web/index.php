<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APP_DIR', __DIR__ . './../');

require '../vendor/autoload.php';

$app = new Slim\App;
$routeLoader = new \Router\Loader($app);
$routeLoader->loadRoutes(require(APP_DIR . '/config/routes.php'));
$app->run();