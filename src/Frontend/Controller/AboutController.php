<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class AboutController extends FrontendController
{

    public function whoAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/about/who.twig', []);
    }

	public function historyAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/about/history.twig', []);
    }

    public function historyActionYear()
    {
        $year = $this->app->router->getCurrentRoute()->getParam('year');

        $this->getBanners(5, 'all');
        $this->app->render('frontend/about/history' . $year . '.twig', []);
    }

	public function teamAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/about/team.twig', []);
    }

	public function jobsAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/about/jobs.twig', []);
    }

	public function newsAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/about/news.twig', []);
    }

}
