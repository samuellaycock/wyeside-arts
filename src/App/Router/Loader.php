<?php

namespace App\Router;


use Slim\App;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;


class Loader
{

    /** @var App */
    protected $app;


    public function __construct(App $app)
    {
        $this->app = $app;
    }


    /**
     * @param array $routeConfigs
     */
    public function loadRoutes(array $routeConfigs)
    {
        $app = $this->app;
        foreach($routeConfigs as $config){
            $this->app->map(
                $config['methods'],
                $config['pattern'],
                function(ServerRequestInterface $request, ResponseInterface $response, array $args) use ($app){
                    $controller = new $args['paths']['controller']($app->getContainer(), $response);
                    $controller->{$args['paths']['action']}();
                }
            )->setArgument('paths', $config['paths']);
        }
    }

}