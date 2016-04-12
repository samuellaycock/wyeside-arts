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
		$type = $this->app->router->getCurrentRoute()->getParam('type');
		$this->getBanners(5, $type);
        $this->app->render('frontend/events/list.twig', []);
    }


    public function eventDetailAction()
    {
		$id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);
        $this->app->render('frontend/events/detail.twig', ['event' => $event]);
    }

}
