<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

// todo: improve this auth system!
session_start();
session_regenerate_id();
$uri_parts = explode('/', ltrim($_SERVER['REQUEST_URI'],'/'));
if($uri_parts[0] == 'system'){
    if($uri_parts[1] != 'login') {
        if(!isset($_SESSION['wyeside-user'])) {
            header('Location: /system/login');
            die();
        }
    }
}
// end of auth

define('APP_DIR', realpath(__DIR__ . '/../'));

/**
 * Load the app's environment
 */
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


$routerService = new App\Service\RouterService($app);
$em = $routerService->loadRoutes(require APP_DIR . '/config/routes.php');

$doctrineService = new App\Service\DoctrineService($app);
$em = $doctrineService->register();

$app->run();