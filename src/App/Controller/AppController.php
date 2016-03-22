<?php

namespace App\Controller;


use Doctrine\ORM\EntityManager;
use Slim\Slim;


class AppController
{

    /** @var Slim*/
    protected $app;

    /** @var EntityManager */
    protected $em;


    /**
     * AppController constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->app = $app;
        $this->setModule();
        $this->em = $this->app->container->get('em');
    }


    protected function setModule()
    {
        $module = '';
        $url = $this->app->request->getPath();

        if(strpos($url, 'events')){
            $module = 'events';
        }elseif(strpos($url, 'blog')){
            $module = 'blog';
        }elseif(strpos($url, 'users')){
            $module = 'users';
        }

        $this->app->flashNow('module', $module);
    }

}