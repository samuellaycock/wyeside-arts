<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Frontend\Controller;

use App\Pagination\Pagination;

/**
 * Class EventController
 * @package Frontend\Controller
 */
class EventController extends FrontendController
{

    public function eventListAction()
    {
        $type = $this->app->router->getCurrentRoute()->getParam('type');
        $typeInt = $this->convertTypeParam($type);

        $this->getDaysFromTo(0, 7, $typeInt);
        $this->getBanners(5, $typeInt);
        $this->app->render('frontend/events/list.twig', ['type' => $type]);
    }


    public function eventDetailAction()
    {
        $id = $this->app->router->getCurrentRoute()->getParam('id');
        $event = $this->getEventRepo()->find($id);

        $showings = $this->getShowingsRepo()->getSortedByDateForEvent($event);
        $organised = [];
        foreach ($showings as $showing) {
            $keyDate = $showing->getTs()->format('Y-m-d');
            if (!isset($organised[$keyDate])) {
                $organised[$keyDate] = [];
            }
            $organised[$keyDate][] = $showing;
        }

        $this->app->render('frontend/events/detail.twig', [
            'event' => $event,
            'days' => $organised
        ]);
    }

    /**
     * @return integer
     */
    private function convertTypeParam($type)
    {
        if (!$type || $type == 'all') {
            return 0;
        } else {
            switch ($type) {
                case 'cinema':
                    return 1;
                case 'live':
                    return 2;
                case 'satellite':
                    return 4;
                case 'gallery':
                    return 6;
                case 'classes':
                    return 10;
                default:
                    return 99;
            }
        }
    }

}
