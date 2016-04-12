<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class HireController extends FrontendController
{

    public function technicalAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/hire/technical.twig', []);
    }
	
	public function costumeAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/hire/costume.twig', []);
    }
	
}
