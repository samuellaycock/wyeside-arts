<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Controller;


use Doctrine\ORM\EntityManager;
use Slim\Slim;

/**
 * Class AppController
 * @package App\Controller
 */
class AppController
{

    /** @var Slim */
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
        $this->em = $this->app->container->get('em');
    }

}