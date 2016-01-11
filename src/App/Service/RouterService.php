<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Service;


use Slim\Slim;


class RouterService
{

    /** @var Slim */
    protected $app;


    public function __construct(Slim $app)
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
            $this->app->map($config['pattern'], function() use ($app, $config){
                $controller = new $config['paths']['controller']($app);
                $controller->{$config['paths']['action']}();
            })->via($config['methods']);
        }
    }

}