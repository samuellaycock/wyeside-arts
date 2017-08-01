<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class OtherController extends FrontendController
{
	
	public function contactAction()
    {
        $this->app->render('frontend/contact/contact.twig', []);
    }

    public function termsAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/terms/terms.twig', []);
    }

    public function sitemapAction()
    {
		$this->getBanners(5, 'all');
        $this->getAll();
        $this->app->render('frontend/sitemap/sitemap.twig', []);
    }

}
