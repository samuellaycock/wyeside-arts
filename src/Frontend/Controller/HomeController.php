<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */
namespace Frontend\Controller;


/**
 * Class IndexController
 * @package Frontend\Controller
 */
class HomeController extends FrontendController
{

    public function homeAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/home.twig', []);
    }
    
}