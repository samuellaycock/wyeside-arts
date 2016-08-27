<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider;

use App\Model\Provider\Entity\EventEntityInterface;
use App\Model\Provider\Ticketsolve\TicketsolveEvent;
use App\Model\Repo\EventRepo;

/**
 * Class Ticketsolve
 * @package App\Model\Provider
 */
class TicketsolveProvider
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
        if (null === $feedUrl) {
            $this->feedUrl = self::DEFAULT_FEED_URL;
        } else {
            $this->feedUrl = (string)$feedUrl;
        }

        $this->eventRepo = $eventRepo;
    }


    /**
     * @return EventEntityInterface[]
     */
    public function events()
    {
        $rawData = file_get_contents($this->feedUrl);
        $xml = simplexml_load_string($rawData);

        $events = [];
        foreach ($xml->show as $event) { // ticketsolve call events shows!
            $events[] = new TicketsolveEvent($event);
        }

        return $events;
    }

    /**
     * @param $ticketSolveEventId
     * @return EventEntityInterface
     * @throws \Exception
     */
    public function eventByEventId($ticketSolveEventId)
    {
        foreach ($this->events() as $event) {
            if ($event->eventId() == $ticketSolveEventId) {
                return $ticketSolveEventId;
            }
        }

        throw new \Exception("Ticketsolve event not found for event id: " . $ticketSolveEventId);
    }

    /**
     * @param $ticketSolveShowingId
     * @return EventEntityInterface
     * @throws \Exception
     */
    public function eventByShowingId($ticketSolveShowingId)
    {
        foreach ($this->events() as $event) {
            foreach ($event->showings() as $showing) {
                if ($showing->showingId() == $ticketSolveShowingId) {
                    return $event;
                }
            }
        }

        throw new \Exception("Ticketsolve event not found for showing id: " . $ticketSolveShowingId);
    }

    /**
     * @param $ticketSolveShowingId
     * @return Entity\ShowingEntityInterface
     * @throws \Exception
     */
    public function showingByShowingId($ticketSolveShowingId)
    {
        foreach ($this->events() as $event) {
            foreach ($event->showings() as $showing) {
                if ($showing->showingId() == $ticketSolveShowingId) {
                    return $showing;
                }
            }
        }

        throw new \Exception("Ticketsolve showing not found for showing id: " . $ticketSolveShowingId);
    }

}