<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider;
use App\Model\Entity\Event;
use App\Model\Entity\Showing;

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
     * @return mixed
     */
    public function downloadFeed()
    {
        $rawData = file_get_contents($this->feedUrl);
        $xml = simplexml_load_string($rawData);

        $events = [];
        foreach($xml->show as $show){
            $events[] = $this->buildEvent($show);
        }

        echo "<pre>";
        print_r($events);
        die();

        return print_r($events, 1);
    }


    /**
     * @param \SimpleXMLElement $show
     * @return Event
     */
    protected function buildEvent(\SimpleXMLElement $show)
    {
        //todo:event number
        $event = new Event();
        $event->setTicketsolve((string)$show->id);
        $event->setTitle(trim((string)$show->name));
        $event->setType((string)$show->event_category); //todo convert to db int
        $event->setDescription((string)$show->long_description);

        if(isset($show->upcoming_events->event)) {
            foreach ($show->upcoming_events->event as $showingData) {
                $showing = new Showing();
                $showing->setTs(new \DateTime($showingData->date));
                $event->addShowing($showing);
            }
        }

        return $event;
    }

}