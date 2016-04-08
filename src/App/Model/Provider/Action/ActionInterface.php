<?php
/**
 * @author James Dobb <james.dobb@gmail.com>
 */

namespace App\Model\Provider\Action;


use App\Model\Provider\Ticketsolve\TicketsolveModel;

/**
 * Interface ActionInterface
 * @package App\Model\Provider\Action
 */
interface ActionInterface
{

    /** @return TicketsolveModel */
    public function getModel();

    /** @return string */
    public function getActionValue();

    /** @return string */
    public function getActionText();

}