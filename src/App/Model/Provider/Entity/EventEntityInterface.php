<?php

namespace App\Model\Provider\Entity;

/**
 * Interface EventEntityInterface
 * @package App\Model\Provider\Entity
 */
interface EventEntityInterface
{

    /** @return string */
    public function eventId();

    /** @return string */
    public function name();

    /** @return string */
    public function description();

    /** @return string */
    public function category();

    /** @return ShowingEntityInterface[] */
    public function showings();

    /**
     * @return array
     */
    public function view();

}