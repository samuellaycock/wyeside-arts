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
     * @param Event $event
     */
    public function setEvent(Event $event)
    {
        $this->event = $event;
    }



    public function getLocationName()
    {
        switch($this->getLocation())
        {
            case 1: return 'Castle Cinema';
            case 2: return 'Market Theatre';
            case 3: return 'Gallery';
            default: return 'Unknown';
        }
    }


}