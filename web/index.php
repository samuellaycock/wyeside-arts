<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

define('APP_DIR', realpath(__DIR__ . '/../'));

/**
 * Load the app's environment
 */
$envFile = APP_DIR . '/config/environment.local.php';
if (!file_exists($envFile)) {
    throw new \Exception('Unable to run app! Please create the required config/environment.local.php file.');
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


$routerService = new App\Service\RouterService($app);
$em = $routerService->loadRoutes(require APP_DIR . '/config/routes.php');

$doctrineService = new App\Service\DoctrineService($app);
$em = $doctrineService->register();

$app->run();