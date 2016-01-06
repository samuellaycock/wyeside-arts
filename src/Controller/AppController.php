<?php

namespace Controller;


use Slim\App;

class AppController
{

    /** @var App */
    protected $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function indexAction()
    {
        return 'Hello, World!';
    }

}