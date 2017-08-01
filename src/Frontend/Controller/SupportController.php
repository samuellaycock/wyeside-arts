<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class SupportController extends FrontendController
{

    public function volunteerAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/support/volunteer.twig', []);
    }
	
	public function friendAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/support/friend.twig', []);
    }
	
	public function funderAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/support/funder.twig', []);
    }
	
}
