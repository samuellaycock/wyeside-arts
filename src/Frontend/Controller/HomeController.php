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
        $this->getDaysFromTo(0, 7, 0);
		$this->getBanners(5, 'all');
        $this->app->render('frontend/home.twig', []);
    }

}
