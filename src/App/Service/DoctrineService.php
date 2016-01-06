<?php

namespace App\Service;


use Slim\Container;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class DoctrineService
{

    /** @var Container */
    protected $container;


    /**
     * DoctrineService constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }


    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function register()
    {

        $paths = [APP_DIR . '/src/App/Module/Entity'];
        $isDevMode = false;
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host'     => $this->container->settings['db_host'],
            'user'     => $this->container->settings['db_user'],
            'password' => $this->container->settings['db_password'],
            'dbname'   => $this->container->settings['db_name']
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $em = EntityManager::create($dbParams, $config);
        $this->container->offsetSet('em', $em);
        return $em;
    }

}