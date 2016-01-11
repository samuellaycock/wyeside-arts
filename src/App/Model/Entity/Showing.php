<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Entity;


/**
 * @Entity
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


}