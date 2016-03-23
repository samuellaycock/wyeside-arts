<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */
namespace Frontend\Controller;


/**
 * Class IndexController
 * @package Frontend\Controller
 */
class IndexController extends FrontendController
{

    public function indexAction()
    {
        $this->app->render('frontend/index.twig');
    }
    
}