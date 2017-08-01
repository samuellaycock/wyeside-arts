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

        $this->getBanners(5, $typeInt);

        $eventsThisWeek = $this->getEventRepo()->getUpcomingWithinXDaysForType(7, $typeInt);
        if(count($eventsThisWeek) >= 0){
            $futureEvents = $this->getEventRepo()->getUpcomingExcludeEventsForType($eventsThisWeek, $typeInt);
        }else{
            $futureEvents = $this->getEventRepo()->getAllSortedByDate($typeInt);
        }

        $this->app->render('frontend/events/list.twig', [
            'type' => $type,
            'eventsThisWeek' => $eventsThisWeek,
            'futureEvents' => $futureEvents
        ]);
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
     * @param $type
     * @return int|null
     */
    private function convertTypeParam($type)
    {
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
                return null;
        }
    }

}
