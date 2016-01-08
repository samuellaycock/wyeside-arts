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


$app = new Slim\Slim([
    'mode' => APP_ENV,
    'templates.path' => APP_DIR . '/views',
    'view' => new \Slim\Views\Twig
]);

$app->get('/', function() use ($app) {
    $app->render('frontend/index.twig');
});

$app->run();


/**
$routeLoader = new \App\Router\Loader($app);
$routeLoader->loadRoutes(require(APP_DIR . '/config/routes.php'));

$twigService = new App\Service\TwigService($di);
$twigService->register();

$doctrineService = new App\Service\DoctrineService($di);
$em = $doctrineService->register();


$repo = $em->getRepository('App\Model\Entity\Event');
echo "<pre>";
print_r($repo->getGenres());
die();

$app->run();
 * */