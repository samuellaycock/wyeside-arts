<?php
/**
 * @author Samuel Laycock <samuel.paul.laycock@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class CalendarController extends FrontendController
{

    public function CalendarAction()
    {
        $this->getBanners(5, 'all');
        $this->getAll();
        $this->app->render('frontend/calendar/index.twig', []);
    }

}
