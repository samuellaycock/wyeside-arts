<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Frontend\Controller;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class EventController extends FrontendController
{

    public function eventListAction()
    {
        $this->app->render('frontend/events/list.twig', []);
    }


    public function eventDetailAction()
    {
        $this->app->render('frontend/events/detail.twig', []);
    }

}