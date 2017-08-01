<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Backend\Controller;


/**
 * Class IndexController
 * @package Backend\Controller
 */
class IndexController extends BackendController
{

    public function indexAction()
    {
        $this->app->redirect('/system/events');
    }

}