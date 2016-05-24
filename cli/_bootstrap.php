<?php

define('APP_DIR', realpath(__DIR__ . '/../'));
$envFile = APP_DIR . '/config/environment.local.php';

if (!file_exists($envFile)) {
    die('Unable to run app! Please create the required config/environment.local.php file.');
} else {
    define('APP_ENV', require $envFile);
}

if (APP_ENV != 'production') {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

require '../vendor/autoload.php';

$app = new Slim\Slim(require APP_DIR . '/config/config.php');

$doctrineService = new App\Service\DoctrineService($app);
$em = $doctrineService->register();

