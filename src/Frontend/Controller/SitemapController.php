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

    public function sitemapAction()
    {
		$this->getBanners(5, 'all');
        $this->app->render('frontend/sitemap/sitemap.twig', []);
    }

}
	