<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
use App\Model\Provider\Action\AlreadySyncedAction;
use App\Model\Provider\Ticketsolve\TicketsolveModel;
use App\Model\Repo\EventRepo;

/**
 * Class Ticketsolve
 * @package App\Model\Provider
 */
class Ticketsolve
{

    CONST DEFAULT_FEED_URL = 'https://wyeside.ticketsolve.com/feeds/shows.xml';

    /** @var string */
    protected $feedUrl;

    /** @var EventRepo */
    protected $eventRepo;


    /**
     * Ticketsolve constructor.
     * @param null $feedUrl
     * @param EventRepo $eventRepo
     */
    public function __construct($feedUrl = null, EventRepo $eventRepo)
    {
        if(null === $feedUrl){
            $this->feedUrl = self::DEFAULT_FEED_URL;
        }else{
            $this->feedUrl = (string)$feedUrl;
        }

        $this->eventRepo = $eventRepo;
    }

    /**
     * @return TicketsolveModel[]
     */
    public function downloadFeedModels()
    {
        $rawData = file_get_contents($this->feedUrl);
        $xml = simplexml_load_string($rawData);

        $events = [];
        foreach($xml->show as $show){
            $events[] = new TicketsolveModel($show, true);
        }

        return $events;
    }


    public function estimateFeedActions()
    {
        $actions = [];
        foreach($this->downloadFeedModels() as $model){
            if($this->eventRepo->eventExistsForTicketsolve($model->getTicketsolveId())){
                $actions[] = new AlreadySyncedAction($model);
            }elseif($this->similarActionExists($model)){

            }
        }
    }


    /**
     * @param TicketsolveModel $model
     */
    protected function similarActionExists(TicketsolveModel $model)
    {
        
    }



}