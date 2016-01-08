<?php

namespace App\Controller;


use Slim\Slim;


class AppController
{

    /** @var Slim*/
    protected $app;


    /**
     * AppController constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->app = $app;
    }

}