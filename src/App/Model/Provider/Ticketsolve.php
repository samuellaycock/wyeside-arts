<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;
use App\Model\Provider\Ticketsolve\TicketsolveModel;

/**
 * Class Ticketsolve
 * @package App\Model\Provider
 */
class Ticketsolve
{

    CONST DEFAULT_FEED_URL = 'https://wyeside.ticketsolve.com/feeds/shows.xml';

    /** @var string */
    protected $feedUrl;


    /**
     * Ticketsolve constructor.
     * @param null $feedUrl
     */
    public function __construct($feedUrl = null)
    {
        if(null === $feedUrl){
            $this->feedUrl = self::DEFAULT_FEED_URL;
        }else{
            $this->feedUrl = (string)$feedUrl;
        }
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



}