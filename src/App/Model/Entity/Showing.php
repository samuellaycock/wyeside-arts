<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;


/**
 * @Entity(repositoryClass="App\Model\Repo\ShowingRepo")
 * @Table(name="eventdate")
 */
class Showing
{

    /**
     * @Id
     * @Column(type="integer", name="dateID")
     * @GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @Column(type="string")
     * @var string
     */
    protected $ticketsolveId;

    /**
     * @Column(type="datetime", name="dateTime")
     * @var \DateTime
     */
    protected $ts;

    /**
     * @Column(type="smallint", name="dateLocation")
     * @var int
     */
    protected $location;

    /**
     * @Column(type="string", name="type")
     * @var string
     */
    protected $type;


    /**
     * @ManyToOne(targetEntity="App\Model\Entity\Event", inversedBy="showings")
     * @JoinColumn(name="eventID", referencedColumnName="eventID")
     * @var Event
     */
    protected $event;


    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return \DateTime
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param \DateTime $ts
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return int
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param int $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }


    /**
     * @return Event
     */
    public function getEvent()
    {
        return $this->event;
    }


    /**
     * @return string
     */
    public function getTicketsolveId()
    {
        return $this->ticketsolveId;
    }

    /**
     * @param $id
     */
    public function setTicketsolveIt($id)
    {
        $this->ticketsolveId = $id;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }



    public function getLocationName()
    {
        $id = $this->getLocation();
        if(isset(self::getLocationMap()[$id])){
            return self::getLocationMap()[$id];
        }
        return 'Unknown';
    }

    /**
     * @return array
     */
    public static function getLocationMap()
    {
        return [
            0 => 'Castle Cinema',
            1 => 'Market Theatre',
            2 => 'Gallery'
        ];
    }


}