<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Frontend\Controller;

use App\Controller\AppController;
use App\Model\Entity\Event;
use App\Model\Repo\EventRepo;
use Slim\Slim;


/**
 * Class FrontendController
 * @package App\Backend\Controller
 */
class FrontendController extends AppController
{

    /**
     * AppController constructor.
     * @param Slim $app
     */
    public function __construct(Slim $app)
    {
        parent::__construct($app);
        $this->setViewGlobals($app);
    }

    /**
     * @return EventRepo
     */
    protected function getEventRepo()
    {
        return $this->em->getRepository(Event::class);
    }

    /**
     * @param Slim $app
     */
    protected function setViewGlobals(Slim $app)
    {
        $eventRepo = $this->getEventRepo();
        $app->flashNow('upcomingEvents', $eventRepo->getXUpcoming(12));
        $app->flashNow('brochureUrl', 'http://wyeside.co.uk'); // todo: we need to store the latest brochure URL somewhere!
    }

  	/**
       * @return Event[]
       */
    protected function getBanners($num, $type)
    {
		    $eventRepo = $this->getEventRepo();
		    $this->app->flashNow('bannerImages', $eventRepo->getXBannerImages($num, $type));
    }

    /**
       * @return Event[]
       */
    protected function getDaysFromTo($from, $to, $type)
    {
        $eventRepo = $this->getEventRepo();
        $this->app->flashNow('thisWeek', $eventRepo->getUpcomingFromXToY($from, $to, $type));
        $this->app->flashNow('nextWeek', $eventRepo->getUpcomingFromXToY(($from + 7), ($to + 7), $type));
    }

    /**
       * @return Event[]
       */
    protected function getAll()
    {
        $eventRepo = $this->getEventRepo();
        $this->app->flashNow('events', $eventRepo->getAllSortedByDate());

        /*
        $eventRepo = $this->getEventRepo();
        $data = array();

        foreach($this->$eventRepo->getAllSortedByDate() as $event){
            $event = array(
                'title' => $this.getTitle(),
                'dates' => array(),
                'image' => $this.getBannerImageUrl() );

            foreach($this.getShowings() as $showing){
                $dateTime = $this.getTs();

                array_push($event['dates'], $dateTime);
            }

            array_push($data, $event);

        }

        return $data;
        */
    }
}
