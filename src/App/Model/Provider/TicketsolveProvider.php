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

    /** @var EventEntityInterface[] */
    protected $events;


    /**
     * TicketsolveProvider constructor.
     * @param null $feedUrl
     */
    public function __construct($feedUrl = null)
    {
        if (null === $feedUrl) {
            $this->feedUrl = self::DEFAULT_FEED_URL;
        } else {
            $this->feedUrl = (string)$feedUrl;
        }
    }


    /**
     * @return EventEntityInterface[]
     */
    public function events()
    {
        if (null === $this->events) {
            $rawData = file_get_contents($this->feedUrl);
            $xml = simplexml_load_string($rawData);

            $events = [];
            foreach ($xml->show as $event) { // ticketsolve call events shows!
                $events[] = new TicketsolveEvent($event);
            }

            $this->events = $events;
        }

        return $this->events;
    }

    /**
     * @param $ticketSolveEventId
     * @return EventEntityInterface|bool
     * @throws \Exception
     */
    public function eventByEventId($ticketSolveEventId)
    {
        foreach ($this->events() as $event) {
            if ((string)$event->eventId() == (string)$ticketSolveEventId) {
                return $event;
            }
        }
        return false;
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


    /**
     * @param EventRepo $eventRepo
     * @return EventEntityInterface[]
     */
    public function eventsNotSynced(EventRepo $eventRepo)
    {
        $rtnEvents = [];
        foreach ($this->events() as $event) {
            if (!$eventRepo->eventExistsForTicketsolve($event->eventId())) {
                $rtnEvents[] = $event;
            }
        }
        return $rtnEvents;
    }

}