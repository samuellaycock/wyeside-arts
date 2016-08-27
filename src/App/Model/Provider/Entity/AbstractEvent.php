<?php

namespace App\Model\Provider\Entity;

/**
 * @author james.dobb@gmail.com
 */
abstract class AbstractEvent implements EventEntityInterface
{

    /** @var string */
    protected $eventId;

    /** @var string */
    protected $name;

    /** @var string */
    protected $description;

    /** @var string */
    protected $category;

    /** @var ShowingEntityInterface[] */
    protected $showings = [];


    /**
     * @return string
     */
    public function eventId()
    {
       return $this->eventId;
    }

    /**
     * @return string
     */
    public function name()
    {
       return $this->name;
    }

    /**
     * @return string
     */
    public function description()
    {
       return $this->description;
    }

    /**
     * @return string
     */
    public function category()
    {
        return $this->category;
    }

    /**
     * @return ShowingEntityInterface[]
     */
    public function showings()
    {
        return $this->showings;
    }


}