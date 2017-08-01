<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace Frontend\Controller;

use App\Controller\AppController;
use App\Model\Entity\Config;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
use App\Model\Entity\Tweet;
use App\Model\Repo\ConfigRepo;
use App\Model\Repo\EventRepo;
use App\Model\Repo\ShowingRepo;
use App\Model\Repo\TweetRepo;
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
     * @return ConfigRepo
     */
    protected function getConfigRepo()
    {
        return $this->em->getRepository(Config::class);
    }

    /**
     * @return ShowingRepo
     */
    protected function getShowingsRepo()
    {
        return $this->em->getRepository(Showing::class);
    }

    /**
     * @return TweetRepo
     */
    protected function getTweetRepo()
    {
        return $this->em->getRepository(Tweet::class);
    }

    /**
     * @param Slim $app
     */
    protected function setViewGlobals(Slim $app)
    {
        $eventRepo = $this->getEventRepo();
        $app->flashNow('upcomingEvents', $eventRepo->getXUpcoming(12));
        $app->flashNow('latestTweet', Tweet::getOne($this->getTweetRepo(), $this->em));
        $app->flashNow('brochureURL', $this->getConfigRepo()->findOneByName('brochureUrl')->getValue());
    }

    /**
     * @param $num
     * @param $type
     */
    protected function getBanners($num, $type)
    {
		    $eventRepo = $this->getEventRepo();
		    $this->app->flashNow('bannerImages', $eventRepo->getXBannerImages($num, $type));
    }
    

    protected function getAll()
    {
        $eventRepo = $this->getEventRepo();
        $this->app->flashNow('events', $eventRepo->getAllSortedByDate());
    }

    /**
     *
     */
    protected function getAllShowings()
    {
        $eventRepo = $this->getEventRepo();
        $this->app->flashNow('showings', $eventRepo->getAllSortedByDate());
    }

}
