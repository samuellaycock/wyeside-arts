<?php
/**
 * @author James Dobb <james.dobb@gmil.com>
 */

namespace App\Service;


use Slim\Slim;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


class DoctrineService
{

    /** @var Slim */
    protected $app;

    /**
     * DoctrineService constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        $this->app = $app;
    }


    /**
     * @return EntityManager
     * @throws \Doctrine\ORM\ORMException
     */
    public function register()
    {
        $paths = [APP_DIR . '/src/App/Module/Entity'];
        $isDevMode = true;
        $dbParams = [
            'driver'   => 'pdo_mysql',
            'host'     => $this->app->config('db.host'),
            'user'     => $this->app->config('db.user'),
            'password' => $this->app->config('db.password'),
            'dbname'   => $this->app->config('db.name')
        ];

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
        $config->setProxyDir('/tmp/wyeside-arts/cache/proxy');
        $em = EntityManager::create($dbParams, $config);
        $this->app->container->offsetSet('em', $em);
        return $em;
    }

}