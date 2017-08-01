<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class VisitController extends FrontendController
{

    public function findAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/find.twig', []);
    }
	
	public function foodAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/food.twig', []);
    }
	
	public function timeAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/time.twig', []);
    }
	
	public function bookAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/book.twig', []);
    }
	
	public function auditoriumAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/auditorium.twig', []);
    }
	
	public function accessAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/visit/access.twig', []);
    }
	
}
	