<?php

namespace App\Model\Provider\Entity;

/**
 * @author james.dobb@gmail.com
 */
abstract class AbstractShowing implements ShowingEntityInterface
{

    /** @var string */
    protected $showingId;

    /** @var int */
    protected $location;

    /** @var \DateTime */
    protected $time;


    /**
     * @return string
     */
    public function showingId()
    {
       return $this->showingId;
    }

    /**
     * @return \DateTime
     */
    public function time()
    {
        return $this->time;
    }

    /**
     * @return int
     */
    public function location()
    {
        return $this->location;
    }


}