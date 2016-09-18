<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;

use App\Controller\AppController;
use App\Model\Entity\Event;
use Slim\Slim;

/**
 * Class BackendController
 * @package App\Backend\Controller
 */
class BackendController extends AppController
{

    /**
     * AppController constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        parent::__construct($app);
        $this->setModule($app);
        $this->setEventTypes($app);
    }


    /**
     * @param Slim $app
     */
    protected function setModule(Slim $app)
    {
        $module = '';
        $url = $app->request->getPath();

        if (strpos($url, 'events')) {
            $module = 'events';
        } elseif (strpos($url, 'blog')) {
            $module = 'blog';
        } elseif (strpos($url, 'users')) {
            $module = 'users';
        } elseif (strpos($url, 'settings')) {
            $module = 'settings';
        }

        $app->flashNow('module', $module);
    }


    /**
     * @param Slim $app
     */
    protected function setEventTypes(Slim $app)
    {
        $app->flashNow('eventTypes', Event::getEventTypes());
    }

}