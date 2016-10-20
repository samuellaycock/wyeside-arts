<?php

namespace App\Model\Provider\Entity;

/**
 * Interface EventEntityInterface
 * @package App\Model\Provider\Entity
 */
interface ShowingEntityInterface
{

    /** @return string */
    public function showingId();

    /** @return \DateTime */
    public function time();

    /** @return int */
    public function location();

}