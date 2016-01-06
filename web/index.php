<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('APP_DIR', realpath(__DIR__ . '/../'));

require '../vendor/autoload.php';

$di = new Slim\Container([
    'settings' => require APP_DIR . '/config/config.php'
]);
$app = new Slim\App($di);

$routeLoader = new \App\Router\Loader($app);
$routeLoader->loadRoutes(require(APP_DIR . '/config/routes.php'));

$twigService = new App\Service\TwigService($di);
$twigService->register();

$doctrineService = new App\Service\DoctrineService($di);
$em = $doctrineService->register();

$app->run();