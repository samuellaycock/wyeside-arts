<?php

namespace App\Service;


use Slim\Container;


class TwigService
{

    /** @var Container */
    protected $container;


    /**
     * TwigService constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * @return \Twig_Environment
     */
    public function register()
    {
        $loader = new \Twig_Loader_Filesystem(APP_DIR . '/views/');
        $twig = new \Twig_Environment($loader);
        $this->container->offsetSet('twig', $twig);
        return $twig;
    }

}